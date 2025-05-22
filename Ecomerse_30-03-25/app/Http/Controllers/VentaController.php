<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Carrito;
use App\Mail\VentaValidadaComprador;
use App\Mail\VentaValidadaVendedor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VentaController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $ventas = Venta::with('usuario', 'productos')->get();
        return view('ventas.index', compact('ventas'));
    }

    // Ya no mostramos la vista de creación aquí para evitar acceso directo
    public function create()
    {
        return redirect()->route('carritos.index');
    }

    public function store(Request $request)
{
    $request->validate([
        'productos' => 'required|array',
        'productos.*.id' => 'required|exists:productos,id',
        'productos.*.cantidad' => 'required|integer|min:1',
        'ticket' => 'required|image|max:2048',
    ]);

    if (!$request->hasFile('ticket')) {
        return back()->withErrors(['ticket' => 'El archivo del ticket es obligatorio.']);
    }

    $ticketFile = $request->file('ticket');

    if (!$ticketFile->isValid()) {
        return back()->withErrors(['ticket' => 'Error al subir el archivo del ticket.']);
    }

    // Guardar el ticket en disco privado
    $pathTicket = $ticketFile->store('tickets', 'privado');

    $total = 0;
    foreach ($request->productos as $item) {
        $producto = Producto::find($item['id']);
        $total += $producto->precio * $item['cantidad'];
    }

    // Crear la venta ya con el path del ticket
    $venta = Venta::create([
        'user_id' => auth()->id(),
        'total' => $total,
        'ticket' => $pathTicket,
        'estado' => 'pendiente',
    ]);

    foreach ($request->productos as $item) {
        $venta->productos()->attach($item['id'], ['cantidad' => $item['cantidad']]);
    }

    return redirect()->route('ventas.index')->with('success', 'Venta registrada con éxito.');
}


    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        return view('ventas.edit', compact('venta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'total' => 'required|numeric|min:0',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->update($request->only(['user_id', 'total', 'fecha']));

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
    }

    public function show($id)
    {
        $venta = Venta::with('productos')->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada.');
    }

    public function validar($id)
    {
        $venta = Venta::with('productos.vendedor', 'usuario')->findOrFail($id);

        // Authorization: solo el gerente puede validar
        $this->authorize('validar', $venta);

        // Cambiar estado
        $venta->estado = 'validada';
        $venta->save();

        // Enviar correo al comprador
        Mail::to($venta->usuario->email)->send(new VentaValidadaComprador($venta));

        // Enviar correo a cada vendedor involucrado en la venta
        foreach ($venta->productos as $producto) {
            if ($producto->vendedor) {
                Mail::to($producto->vendedor->email)->send(new VentaValidadaVendedor($venta, $producto));
            }
        }

        return redirect()->route('ventas.index')->with('success', 'Venta validada y correos enviados.');
    }

    public function showTicket(Venta $venta)
    {
        // Autorizar que el usuario pueda ver esa venta
        $this->authorize('view', $venta);

        // Verificar si el ticket existe
        if (!$venta->ticket || !\Storage::disk('privado')->exists($venta->ticket)) {
            abort(404, 'Ticket no encontrado.');
        }

        // Obtener el contenido del archivo
        $file = \Storage::disk('privado')->get($venta->ticket);

        // Obtener el tipo MIME del archivo
        $mime = \Storage::disk('privado')->mimeType($venta->ticket);

        // Devolver la imagen para que el navegador la muestre
        return response($file, 200)->header('Content-Type', $mime);
    }
}
