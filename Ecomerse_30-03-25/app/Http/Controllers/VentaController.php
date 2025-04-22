<?php

namespace App\Http\Controllers;
use App\Models\Venta;
use App\Models\Producto;
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
        $productos = Producto::all();
        return view('ventas.create', compact('productos'));
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
            $producto = \App\Models\Producto::find($item['id']);
            $total += $producto->precio * $item['cantidad'];
        }

        $venta = Venta::create([
            'usuario_id' => auth()->id(),
            'total' => $total,
            'estado' => 'completada',
        ]);

        foreach ($request->productos as $item) {
            $venta->productos()->attach($item['id'], ['cantidad' => $item['cantidad']]);
        }

        return redirect()->route('ventas.index')->with('success', 'Venta registrada con éxito.');
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

}
