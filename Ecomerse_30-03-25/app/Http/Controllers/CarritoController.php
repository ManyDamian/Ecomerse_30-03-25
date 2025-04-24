<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarritoRequest;
use App\Models\Carrito;
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

        $carrito = new Carrito();
        $carrito->user_id = Auth::id(); // 👈 Este valor es obligatorio
        $carrito->producto_id = $validated['producto_id'];
        $carrito->cantidad = $validated['cantidad'];
        $carrito->save();

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
}
