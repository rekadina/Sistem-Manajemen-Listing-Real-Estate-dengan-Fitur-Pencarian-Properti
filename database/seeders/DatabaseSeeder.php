<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Panggil Seeder User dulu (Admin, dll)
        $this->call([
            AdminUserSeeder::class, // Pastikan ini ada
            // UserSeeder::class,   // Jika ada seeder user lain
        ]);

        // 2. WAJIB: Panggil CategorySeeder di sini!
        $this->call(CategorySeeder::class); 

        // 3. Panggil seeder lain (jika ada)
        // $this->call(PropertySeeder::class);
    }
}