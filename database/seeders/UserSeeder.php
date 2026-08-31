<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@contoh.com',
            'password' => Hash::make('password'),
            'role' => 'pimpinan',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@contoh.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
