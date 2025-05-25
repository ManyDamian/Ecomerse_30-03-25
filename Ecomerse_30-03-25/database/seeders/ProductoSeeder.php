<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\User;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // Aquí puedes crear productos fijos que también tengan categoría y usuario
         $productos = [
            ['nombre' => 'Monitor 24 LG', 'descripcion' => 'Monitor IPS Full HD', 'precio' => 3200.00, 'stock' => 15,'user_id' => 2, 'imagenes' => ['']],
            ['nombre' => 'Teclado Mecánico Redragon', 'descripcion' => 'Retroiluminado RGB para gaming', 'precio' => 890.00, 'stock' => 30,'user_id' => 3, 'imagenes' => ['']],
            /*['nombre' => 'Bocinas Logitech Z313', 'descripcion' => 'Sistema 2.1 para PC', 'precio' => 760.00, 'stock' => 20],
            ['nombre' => 'Aspiradora Xiaomi', 'descripcion' => 'Aspiradora inteligente robot', 'precio' => 4599.00, 'stock' => 10],
            ['nombre' => 'Mouse Gamer Razer', 'descripcion' => 'Mouse ergonómico con sensor óptico', 'precio' => 1150.00, 'stock' => 25],
            ['nombre' => 'Consola PlayStation 5', 'descripcion' => 'Última generación de Sony', 'precio' => 12500.00, 'stock' => 5],
            ['nombre' => 'Audífonos JBL Tune 500', 'descripcion' => 'Audífonos inalámbricos con micrófono', 'precio' => 650.00, 'stock' => 40],
            ['nombre' => 'Refrigerador Mabe 14 pies', 'descripcion' => 'Refrigerador con congelador', 'precio' => 8400.00, 'stock' => 8],
            ['nombre' => 'Laptop HP Ryzen 5', 'descripcion' => 'Laptop 8GB RAM, 256GB SSD', 'precio' => 13500.00, 'stock' => 12],
            ['nombre' => 'Smart TV Samsung 50"', 'descripcion' => '4K UHD con sistema Tizen', 'precio' => 9900.00, 'stock' => 7],
            */];

        $categorias = Categoria::all();
        $vendedores = User::where('role', 'cliente')->where('subrol', 'vendedor')->get();

        foreach ($vendedores as $vendedor) {
            // Crear mínimo 3 productos para cada vendedor
            Producto::factory(3)->create([
                'user_id' => $vendedor->id,
            ])->each(function ($producto) use ($categorias) {
                if ($categorias->count()) {
                    $producto->categorias()->attach(
                        $categorias->random(rand(1, 3))->pluck('id')->toArray()
                    );
                }
            });
        }


        foreach ($productos as $productoData) {
            $producto = Producto::create($productoData);
            if ($categorias->count()) {
                $producto->categorias()->attach(
                    $categorias->random(rand(1, 3))->pluck('id')->toArray()
                );
            }
        }
    }
}
