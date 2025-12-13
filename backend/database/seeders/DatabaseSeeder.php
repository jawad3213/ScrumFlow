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
        'name' => 'Super Chef',
        'email' => 'chef@projet.com',
        'password' => Hash::make('password123'), // Mot de passe crypté
        'role' => 'chef',
    ]);

    User::create([
        'name' => 'Super Amin',
        'email' => 'chefAmin@projet.com',
        'password' => Hash::make('password123A'), // Mot de passe crypté
        'role' => 'chef',
    ]);
    }
}
