<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@ecom.com'],
            [
                'name' => 'Admi',
                'password' => Hash::make('admin12345'), 
                'role' => 'gerente',
            ]
        );
    }
}
