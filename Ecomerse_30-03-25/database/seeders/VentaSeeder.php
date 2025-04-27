<?php

namespace Database\Seeders;
use App\Models\Venta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear una venta
        $venta = Venta::create([
            'user_id' => 2,
            'total' => 200.00,
        ]);

        // Asociar productos a la venta con cantidad
        $venta->productos()->attach([
            1 => ['cantidad' => 2], // Producto con ID 1, cantidad 2
            2 => ['cantidad' => 1], // Producto con ID 2, cantidad 1
        ]);
    }
}
