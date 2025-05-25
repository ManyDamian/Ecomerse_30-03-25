<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareParameterTypeException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $this->call(CategoriaSeeder::class);
    $this->call(UserSeeder::class);
    $this->call(ProductoSeeder::class);
    $this->call(CarritoSeeder::class);
    $this->call(VentaSeeder::class);
    
}

}
