<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;
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
    /*
    dd([
        'hasFile' => $request->hasFile('ticket'),
        'fileIsValid' => $request->file('ticket') ? $request->file('ticket')->isValid() : false,
        'fileInfo' => $request->file('ticket') ? $request->file('ticket')->getClientOriginalName() : null,
    ]);
    */
    // Validar datos recibidos
    $request->validate([
        'productos' => 'required|array',
        'productos.*.id' => 'required|exists:productos,id',
        'productos.*.cantidad' => 'required|integer|min:1',
        'ticket' => 'required|image|max:2048', // obligatorio y tipo imagen máximo 2MB
    ]);

    // Validar que venga archivo y que sea válido
    if (!$request->hasFile('ticket') || !$request->file('ticket')->isValid()) {
        return back()->withErrors(['ticket' => 'El archivo del ticket es obligatorio y debe ser válido.']);
    }

    // Guardar el ticket en disco privado (configura el disco 'privado' en config/filesystems.php)
    $pathTicket = $request->file('ticket')->store('tickets', 'privado');
    //dd($pathTicket);
    // Calcular total sumando precio * cantidad
    $total = 0;
    foreach ($request->productos as $item) {
        $producto = Producto::find($item['id']);
        $total += $producto->precio * $item['cantidad'];
    }

    // Crear la venta
    $venta = Venta::create([
        'user_id' => auth()->id(),
        'total' => $total,
        'ticket' => $pathTicket,
        'estado' => 'pendiente', // estado inicial
    ]);

    // Guardar relación productos - venta con cantidades
    foreach ($request->productos as $item) {
        $venta->productos()->attach($item['id'], ['cantidad' => $item['cantidad']]);
    }
    // Carrito::where('user_id', auth()->id())->delete();

    return redirect()->route('ventas.index')->with('success', 'Venta registrada con éxito.');
}

public function ticket($id)
{
    $venta = Venta::findOrFail($id);

    if (!$venta->ticket || !Storage::disk('app/privado')->exists($venta->ticket)) {
        abort(404, 'Ticket no encontrado');
    }

    return Storage::disk('app/privado')->download($venta->ticket);
}


    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        return view('ventas.edit', compact('venta'));
    }

   public function update(Request $request, $id)
{
    $venta = Venta::findOrFail($id);

    // Validar campos básicos
    $request->validate([
        'total' => 'required|numeric|min:0',
        'validar' => 'sometimes|boolean',
    ]);

    // Actualizar total y otros campos permitidos
    $venta->total = $request->input('total');

    // Solo el gerente puede validar la venta
    if ($request->has('validar') && $request->input('validar')) {
        $this->authorize('validar', $venta);  // autorización
        if ($venta->estado === 'pendiente') {
            $venta->estado = 'validada';
        }
    }

    $venta->save();

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
