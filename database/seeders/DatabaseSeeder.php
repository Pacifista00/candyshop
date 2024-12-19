<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Menambahkan data Role
        Role::insert([
            ['name' => 'admin'],
            ['name' => 'customer'],
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'customer',
            'email' => 'customer@example.com',
            'password' => bcrypt('customer123'),
            'role_id' => 2,
        ]);
    }
}
