<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah user admin sudah ada? Kalau belum, buat baru.
        $user = User::where('email', 'admin@gmail.com')->first();

        if (!$user) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',  // Username login
                'password' => Hash::make('admin123'), // Password login
                'role' => 'admin',             // Role Sakti
                'email_verified_at' => now(),
            ]);
            echo "Akun Admin BERHASIL dibuat! \n";
        } else {
            // Jika sudah ada, kita update password dan role-nya biar yakin
            $user->update([
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]);
            echo "Akun Admin SUDAH ADA. Password di-reset ke admin123. \n";
        }
    }
}