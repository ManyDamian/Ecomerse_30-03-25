<?php

namespace App\Http\Controllers;
use App\Models\User; // Importa el modelo correcto
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
{
    $empleados = User::where('role', 'empleado')->get();
    return view('empleados.index', compact('empleados'));
}


    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']), 
        'role' => 'empleado', // Establecemos el rol correctamente
    ]);

    return redirect()->route('empleados.index')->with('success', 'Empleado registrado correctamente');
}

public function edit(User $empleado)
{
    return view('empleados.edit', compact('empleado'));
}


public function update(Request $request, User $empleado)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $empleado->id,
    ]);

    $empleado->update($request->only('name', 'email'));

    return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente');
}


public function destroy(User $empleado)
{
    $empleado->delete();
    return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente');
}

}
