<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
        'first_name' => 'Super',
        'last_name' => 'Chef',
        'email' => 'chef@projet.com',
        'password' => Hash::make('password123'), // Mot de passe crypté
        'role' => 'chef',
    ]);

    User::create([
        'first_name' => 'Super Amin',
         'last_name' => 'Aelhail',
        'email' => 'chefAmin@projet.com',
        'password' => Hash::make('password123A'), // Mot de passe crypté
        'role' => 'chef',
    ]);

    User::create([
        'first_name' => 'AHMED',
         'last_name' => 'Aelhail',
        'email' => 'Ahmed@projet.com',
        'password' => Hash::make('Ahmed123'), // Mot de passe crypté
        'role' => 'employee',
    ]);
    User::create([
        'first_name' => 'Jaouad',
        'last_name' => 'Aelhail',
        'email' => 'aelhail71@gmail.com',
        'password' => Hash::make('Password123'), // Mot de passe crypté
        'role' => 'chef',
    ]);

    }
}
