<?php

namespace App\Http\Controllers;
//use App\Models\Cliente;
use App\Models\User; // Importa el modelo correcto
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    
    $clientes = User::where('role', 'cliente')->get();
    return view('clientes.index', compact('clientes'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('clientes.create'); // Asegúrate de que el nombre de la vista es correcto
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:clientes,email',
        'password' => 'required|string|min:6',
    ]);

    // Guardar el cliente con contraseña encriptada
        User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    return redirect()->route('clientes.index')->with('success', 'Cliente registrado correctamente');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $cliente = User::findOrFail($id); // Asegúrate de que está buscando en la tabla correcta
    return view('clientes.edit', compact('cliente'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $cliente = User::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'subrol' => 'required|in:comprador,vendedor', // Validación del subrol
    ]);

    $cliente->update($validated); // Actualiza también el subrol automáticamente

    return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
