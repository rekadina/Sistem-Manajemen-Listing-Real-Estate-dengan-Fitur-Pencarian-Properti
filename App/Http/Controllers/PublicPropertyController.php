<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PublicPropertyController extends Controller
{
    /**
     * Menampilkan detail properti untuk User/Public.
     */
    public function show(Property $property)
    {
        // Muat relasi user dan kategori agar bisa ditampilkan
        $property->load(['user', 'category']);

        // Arahkan ke view detail yang sudah kita buat tadi
        return view('properties.show', compact('property'));
    }
}