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

        // Usuarios que han publicado al menos un producto (vendedores)
        $vendedores = User::has('productos')->count();

        // Usuarios que han realizado al menos una venta (compradores)
        $compradores = User::has('ventas')->count();

        // Productos por categoría
        $categoriasConConteo = Categoria::withCount('productos')->get();

        // Producto más vendido (por cantidad total vendida desde la tabla pivote producto_venta)
        $productoMasVendido = Producto::withSum('ventas as total_vendido', 'producto_venta.cantidad')
            ->orderByDesc('total_vendido')
            ->first();

        // Comprador más frecuente por categoría (usando relaciones Eloquent en PHP)
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
            'categoriasConConteo',
            'productoMasVendido',
            'compradoresFrecuentes'
        ));
    }
}
