<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();  // Obtiene todos los productos
        return view('productos.index', compact('productos'));  // Pasa los productos a la vista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');  // Asegurarse de que retorna la vista 'create'
    }

    public function store(Request $request)
{
    // Primero valida los campos del formulario (sin incluir user_id)
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
    ]);

    // Luego añade el user_id manualmente
    

    Producto::create($validated);

    return redirect()->route('productos.index')->with('success', 'Producto registrado correctamente');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        return view('productos.show', compact('producto'));
    }

    // Mostrar el formulario para editar un producto
    public function edit($id)
    {
        $producto = Producto::find($id);
        return view('productos.edit', compact('producto'));
    }

    // Actualizar un producto específico
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $producto = Producto::find($id);
        $producto->update([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
            'precio' => $validated['precio'],
            'stock' => $validated['stock'],
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
