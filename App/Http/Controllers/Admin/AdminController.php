<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;
// use App\Models\Inquiry; // Uncomment this if/when you have the Inquiry model created

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Data Statistik
        $stats = [
            'totalProperties'     => Property::count(),
            'featuredProperties'  => Property::where('featured', true)->count(),
            'activeProperties'    => Property::where('status', 'active')->count(),
            'totalAgents'         => User::count(),
            'myProperties'        => Property::where('user_id', auth()->id())->count(),
        ];

        // 2. Data Properti Terbaru
        $recentProperties = Property::with(['user', 'category'])
                                    ->latest()
                                    ->take(5)
                                    ->get();

        // 3. Data Inquiries (Pesan Masuk)
        // Gunakan collect([]) agar tipe datanya menjadi Collection (Objek), bukan Array biasa.
        // Ini penting agar perintah ->count() di file Blade tidak error.
        $recentInquiries = collect([]); 

        // 4. Kirim semua data ke View
        return view('admin.dashboard', compact('stats', 'recentProperties', 'recentInquiries'));
    }
}   