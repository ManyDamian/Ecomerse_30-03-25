<?php

namespace Database\Seeders;

use App\Models\Carrito;
use App\Models\User;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class CarritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener un usuario y un producto existentes
        $user = User::first();
        $producto = Producto::first();

        // Asegurarse de que existan antes de crear un carrito
        if ($user && $producto) {
            Carrito::create([
                'user_id' => $user->id,
                'producto_id' => $producto->id,
                'cantidad' => 2,
            ]);
        } else {
            echo "No se pudo crear el carrito: asegúrate de tener al menos un usuario y un producto en la base de datos.\n";
        }
    }
}
