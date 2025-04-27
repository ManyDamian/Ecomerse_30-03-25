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
                'name' => 'Admi',
                'password' => Hash::make('admin12345'), 
                'role' => 'gerente',
            ]
        );

        // Crear usuarios con contraseñas
        User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Ana García',
            'email' => 'ana@example.com',
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
    }
}
