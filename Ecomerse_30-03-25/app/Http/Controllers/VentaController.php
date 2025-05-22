<?php

namespace App\Http\Controllers;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Carrito;
use App\Mail\VentaValidadaComprador;
use App\Mail\VentaValidadaVendedor;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with('usuario', 'productos')->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $carritos = Carrito::with('producto')->get(); // o lo que necesites
        return view('ventas.create', compact('carritos'));
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);
    
        $total = 0;
        foreach ($request->productos as $item) {
            $producto = Producto::find($item['id']);
            $total += $producto->precio * $item['cantidad'];
        }
    
        // Crear la venta
        $venta = Venta::create([
            'user_id' => auth()->id(),
            'total' => $total,
        ]);
    
        // Asociar productos a la venta
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

}
