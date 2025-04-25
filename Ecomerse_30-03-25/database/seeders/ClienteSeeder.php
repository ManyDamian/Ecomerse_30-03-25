<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            ['name' => 'Juan Pérez',    'email' => 'juan@example.com',   'password' => 'juan123'],
            ['name' => 'Ana García',    'email' => 'ana@example.com',    'password' => 'ana123'],
            ['name' => 'Luis Romero',   'email' => 'luis@example.com',   'password' => 'luis123'],
            ['name' => 'Marta Sánchez', 'email' => 'marta@example.com',  'password' => 'marta123'],
            ['name' => 'Carlos Ruiz',   'email' => 'carlos@example.com', 'password' => 'carlos123'],
        ];

        foreach ($clientes as $cliente) {
            Cliente::create([
                'name' => $cliente['name'],
                'email' => $cliente['email'],
                'password' => Hash::make($cliente['password']),
            ]);
        }
    }
}
