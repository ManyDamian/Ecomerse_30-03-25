<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@ecom.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('nimda'), 
                'role' => 'gerente',
            ]
        );

        // Crear usuarios con contraseñas
        User::create([
            'name' => 'cliente',
            'email' => 'juan@cliente.com',
            'password' => Hash::make('etneilc'),
        ]);

        User::create([
            'name' => 'Ana García',
            'email' => 'ana@cliente.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Julieta venegas',
            'email' => 'venejul@empleado.com',
            'password' => Hash::make('password123'),
            'role' => 'empleado'
        ]);

        User::create([
            'name' => 'Luis Miguel',
            'email' => 'luismi@empleado.com',
            'password' => Hash::make('password123'),
            'role' => 'empleado'
        ]);

        User::create([
            'name' => 'Nicolas Jesus',
            'email' => 'nicojeuss@empleado.com',
            'password' => Hash::make('fornitesenal'),
            'role' => 'empleado'
        ]);

         // Crear 70 compradores
        User::factory(70)->create([
            'role' => 'cliente',
            'subrol' => 'comprador',
        ]);

        // Crear 30 vendedores
        $vendedores = User::factory(30)->create([
            'role' => 'cliente',
            'subrol' => 'vendedor',
        ]);

        

    }
}
