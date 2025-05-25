<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total de usuarios registrados
        $totalUsuarios = User::count();

        // Vendedores: usuarios con role 'cliente' y subrol 'vendedor' 
        $vendedores = User::where('role', 'cliente')
            ->where('subrol', 'vendedor')
            ->count();

        // Compradores: usuarios con role 'cliente' y subrol 'comprador' 
        $compradores = User::where('role', 'cliente')
            ->where('subrol', 'comprador')
            ->count();

        $gerentes = User::where('role', 'gerente')
            ->count();

        $empleados = User::where('role', 'empleado')
            ->count();

            $clientes = User::where('role', 'cliente')
            ->count();

        // Productos por categoría con conteo
        $categoriasConConteo = Categoria::withCount('productos')->get();

        // Producto más vendido (por cantidad total vendida desde la tabla pivote producto_venta)
        $productoMasVendido = Producto::withSum('ventas as total_vendido', 'producto_venta.cantidad')
            ->orderByDesc('total_vendido')
            ->first();

        // Comprador más frecuente por categoría
        $categorias = Categoria::with('productos.ventas.comprador')->get();
        $compradoresFrecuentes = [];

        foreach ($categorias as $categoria) {
            $frecuencias = [];

            foreach ($categoria->productos as $producto) {
                foreach ($producto->ventas as $venta) {
                    $compradorId = $venta->comprador->id ?? null;
                    if ($compradorId) {
                        $frecuencias[$compradorId] = ($frecuencias[$compradorId] ?? 0) + 1;
                    }
                }
            }

            if (!empty($frecuencias)) {
                arsort($frecuencias);
                $compradorId = array_key_first($frecuencias);
                $compradoresFrecuentes[$categoria->id] = [
                    'categoria' => $categoria->nombre,
                    'comprador' => User::find($compradorId)->name ?? 'Desconocido',
                    'compras' => $frecuencias[$compradorId],
                ];
            } else {
                $compradoresFrecuentes[$categoria->id] = [
                    'categoria' => $categoria->nombre,
                    'comprador' => 'Ninguno',
                    'compras' => 0,
                ];
            }
        }

        return view('estadistica.index', compact(
            'totalUsuarios',
            'vendedores',
            'compradores',
            'gerentes',
            'empleados',
            'clientes',
            'categoriasConConteo',
            'productoMasVendido',
            'compradoresFrecuentes'
        ));
    }
}
