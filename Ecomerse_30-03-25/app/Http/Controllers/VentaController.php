<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;
use App\Models\Carrito;
use App\Mail\VentaValidadaVendedor;
use App\Mail\VentaValidadaComprador;
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

    // Solo permitir editar el campo 'estado'
    $request->validate([
        'estado' => 'required|in:pendiente,validada',
    ]);

    // Solo permitir al gerente validar
    if ($venta->estado !== $request->estado) {
        if ($request->estado === 'validada') {
            $this->authorize('validar', $venta);
        }
        $venta->estado = $request->estado;
    }

    $venta->save();

    return redirect()->route('ventas.index')->with('success', 'Estado de la venta actualizado correctamente.');
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
    $venta = Venta::with('productos.vendedor', 'comprador')->findOrFail($id);
    
    // Cambiar estado a 'validada'
    $venta->estado = 'validada';
    $venta->save();

    // Enviar correo a cada vendedor de los productos de la venta
    foreach ($venta->productos as $producto) {
        if ($producto->vendedor) {
            try {
                Mail::to($producto->vendedor->email)
                    ->send(new VentaValidadaVendedor($venta, $producto));
            } catch (\Exception $e) {
                \Log::error("Error al enviar correo al vendedor (Producto ID {$producto->id}): " . $e->getMessage());
            }
        } else {
            \Log::error("Producto {$producto->id} sin vendedor asignado.");
        }
    }

    // Enviar correo al comprador
    try {
        Mail::to($venta->comprador->email)
            ->send(new VentaValidadaComprador($venta));
    } catch (\Exception $e) {
        \Log::error("Error al enviar correo al comprador (Venta ID {$venta->id}): " . $e->getMessage());
    }

    return redirect()->back()->with('success', 'Venta validada y correos enviados (si no hubo errores).');
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
