<?php

namespace Database\Seeders;

use App\Models\{User, Admin, Pemilik};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::create([
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'role' => 'admin'
        ]);

        Admin::create([
            'name' => 'Admin',
            'user_id' => $admin->id
        ]);

        $pemilik = User::create([
            'email' => 'pemilik@gmail.com',
            'password' => 'pemilik123',
            'role' => 'pemilik'
        ]);
        
        Pemilik::create([
            'name' => 'Pemilik',
            'nib' => '123456789123',
            'no_hp' => '081234567891',
            'user_id' => $pemilik->id
        ]);
    }
}
