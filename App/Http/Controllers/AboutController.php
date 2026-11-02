<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        // Data agen properti
        $agents = [
            [
                'id' => 1,
                'name' => 'Ahmad Hidayat',
                'title' => 'Luxury Property Specialist',
                'avatar' => 'https://images.unsplash.com/photo-1560025097-0a7be682ba20?w=400&h=400&fit=crop',
                'linkedin' => '#',
                'email' => 'ahmad@example.com'
            ],
            [
                'id' => 2,
                'name' => 'Siti Nurhaliza',
                'title' => 'Luxury Property Specialist',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=400&fit=crop',
                'linkedin' => '#',
                'email' => 'siti@example.com'
            ],
            [
                'id' => 3,
                'name' => 'Budi Santoso',
                'title' => 'Luxury Property Specialist',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop',
                'linkedin' => '#',
                'email' => 'budi@example.com'
            ],
            [
                'id' => 4,
                'name' => 'Dewi Lestari',
                'title' => 'Luxury Property Specialist',
                'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop',
                'linkedin' => '#',
                'email' => 'dewi@example.com'
            ]
        ];

        return view('about', compact('agents'));
    }
}