<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarritoRequest;
use App\Models\Carrito;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carritos = Carrito::with('producto', 'user')->get();
        return view('carritos.index', compact('carritos'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('carritos.create', compact('productos'));
    }

    public function store(StoreCarritoRequest $request)
    {
        $validated = $request->validated();
        $userId = Auth::id();

        // Verifica si ya existe el producto en el carrito del usuario
        $carritoExistente = Carrito::where('user_id', $userId)
                            ->where('producto_id', $validated['producto_id'])
                            ->first();

        if ($carritoExistente) {
            // Si ya está, solo actualiza la cantidad
            $carritoExistente->cantidad += $validated['cantidad'];
            $carritoExistente->save();
        } else {
            // Si no, crea un nuevo registro
            Carrito::create([
                'user_id' => $userId,
                'producto_id' => $validated['producto_id'],
                'cantidad' => $validated['cantidad'],
            ]);
        }

        return redirect()->route('carritos.index')->with('success', 'Producto agregado al carrito.');
    }

    public function show(Carrito $carrito)
    {
        return view('carritos.show', compact('carrito'));
    }

    public function edit(Carrito $carrito)
    {
        $productos = Producto::all();
        return view('carritos.edit', compact('carrito', 'productos'));
    }

    public function update(StoreCarritoRequest $request, Carrito $carrito)
    {
        $carrito->update($request->validated());
        return redirect()->route('carritos.index')->with('success', 'Carrito actualizado correctamente.');
    }

    public function destroy(Carrito $carrito)
    {
        $carrito->delete();
        return redirect()->route('carritos.index')->with('success', 'Producto eliminado del carrito.');
    }
    public function comprar()
{
    $user = Auth::user();

    $carritos = Carrito::with('producto')->where('user_id', $user->id)->get();

    if ($carritos->isEmpty()) {
        return redirect()->route('carritos.index')->with('error', 'Tu carrito está vacío.');
    }

    return view('ventas.create', compact('carritos'));
}

}
