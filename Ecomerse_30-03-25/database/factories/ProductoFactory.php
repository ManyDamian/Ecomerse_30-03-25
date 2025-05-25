<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
        'nombre' => $this->faker->word,
        'descripcion' => $this->faker->sentence,
        'precio' => $this->faker->randomFloat(2, 10, 1000),
        'stock' => $this->faker->numberBetween(1, 100),
        'user_id' => null, // se asigna en el seeder
        'imagenes' => [], // puedes dejarlo vacío por ahora
    ];
    }
}
