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
        $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'ticket' => 'required|image|max:2048',
        ]);

        if (!$request->hasFile('ticket') || !$request->file('ticket')->isValid()) {
            return back()->withErrors(['ticket' => 'El archivo del ticket es obligatorio y debe ser válido.']);
        }

        // Guardar el ticket en disco privado
        $pathTicket = $request->file('ticket')->store('tickets', 'privado');

        // Calcular el total
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
            'estado' => 'pendiente',
            'fecha_venta' => now(), // si tienes el campo `fecha` en la tabla
        ]);

        // Asociar productos con cantidades
        foreach ($request->productos as $item) {
            $venta->productos()->attach($item['id'], ['cantidad' => $item['cantidad']]);
        }

        // Vaciar el carrito del usuario
        Carrito::where('user_id', auth()->id())->delete();

        return redirect()->route('ventas.index')->with('success', 'Compra finalizada correctamente.');
    }

    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        return view('ventas.edit', compact('venta'));
    }

  public function update(Request $request, $id)
    {
        //agregamos para informar que venta es una variable
        /** @var \App\Models\Venta $venta */
        $venta = Venta::with('productos.vendedor', 'comprador')->findOrFail($id);

        // Validar solo el campo estado
        $request->validate([
            'estado' => 'required|in:pendiente,validada',
        ]);

        if ($venta->estado !== $request->estado) {
            if ($request->estado === 'validada') {
                $this->authorize('validar', $venta);
            }

            $venta->estado = $request->estado;
            $venta->save();

            // Si cambió a validada, enviar correos
            if ($venta->estado === 'validada') {
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

                try {
                    Mail::to($venta->comprador->email)
                        ->send(new VentaValidadaComprador($venta));
                } catch (\Exception $e) {
                    \Log::error("Error al enviar correo al comprador (Venta ID {$venta->id}): " . $e->getMessage());
                }
            }
        }

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
