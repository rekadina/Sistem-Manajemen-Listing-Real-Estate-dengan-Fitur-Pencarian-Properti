<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Get statistics
            $stats = [
                'totalProperties' => Property::count(),
                'activeProperties' => Property::where('status', 'active')->count(),
                'soldProperties' => Property::where('status', 'sold')->count(),
                'featuredProperties' => Property::where('featured', true)->count(),
                'myProperties' => Property::where('user_id', auth()->id())->count(),
                'totalInquiries' => Inquiry::count(),
                'totalUsers' => User::count(),
            ];

            // Get recent properties
            $recentProperties = Property::with(['category', 'user'])
                ->latest()
                ->take(6)
                ->get();

            // Get recent inquiries
            $recentInquiries = Inquiry::with(['property'])
                ->latest()
                ->take(5)
                ->get();

            return view('admin.dashboard', compact('stats', 'recentProperties', 'recentInquiries'));

        } catch (\Exception $e) {
            // Fallback jika ada error
            $stats = [
                'totalProperties' => 0,
                'activeProperties' => 0,
                'soldProperties' => 0,
                'featuredProperties' => 0,
                'myProperties' => 0,
                'totalInquiries' => 0,
                'totalUsers' => 0,
            ];
            
            $recentProperties = collect();
            $recentInquiries = collect();

            return view('admin.dashboard', compact('stats', 'recentProperties', 'recentInquiries'));
        }
    }
}