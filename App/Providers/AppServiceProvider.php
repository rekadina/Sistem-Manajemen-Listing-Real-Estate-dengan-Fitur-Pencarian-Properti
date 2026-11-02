<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema; // Penting untuk pengecekan tabel
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Menggunakan try-catch agar tidak error saat migrate
        try {
            // Cek apakah tabel 'categories' sudah benar-benar ada di database?
            if (Schema::hasTable('categories')) {
                // Cek apakah kolom 'is_active' ada? (Opsional, tapi aman)
                if (Schema::hasColumn('categories', 'is_active')) {
                    
                    // Kalau semua aman, baru jalankan query ini
                    $categories = Category::where('is_active', 1)->get();
                    View::share('categories', $categories);
                    
                }
            }
        } catch (\Exception $e) {
            // Jika ada error apa pun (misal database mati/belum ada), 
            // biarkan aplikasi jalan terus (jangan crash).
        }
    }
}