<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        // Crea categorías de ejemplo
        Categoria::create([
            'nombre' => 'Tecnología',
            'descripcion' => 'Productos tecnológicos de última generación',
        ]);

        Categoria::create([
            'nombre' => 'Gaming',
            'descripcion' => 'Todo lo relacionado con videojuegos y accesorios',
        ]);

        Categoria::create([
            'nombre' => 'Electrodomésticos',
            'descripcion' => 'Electrodomésticos y artículos para el hogar',
        ]);

        */

         $categorias = [
        ['nombre' => 'Ofertas', 'descripcion' => 'Productos con descuento'],
        ['nombre' => 'Tecnología', 'descripcion' => 'Gadgets y dispositivos'],
        ['nombre' => 'Hogar', 'descripcion' => 'Artículos para el hogar'],
        ['nombre' => 'Gaming', 'descripcion' => 'Accesorios y consolas'],
        ['nombre' => 'Moda', 'descripcion' => 'Ropa y accesorios'],
    ];
    foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(['nombre' => $categoria['nombre']], $categoria);


        // Categoria::factory()->count(10)->create();
    }
}
}
