<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class PropertyImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gambar placeholder dari Unsplash (real estate themes)
        $imageUrls = [
            'https://images.unsplash.com/photo-1570129477492-45a003537e20?w=800&q=80', // Modern apartment
            'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800&q=80', // Luxury home
            'https://images.unsplash.com/photo-1512917774080-9b274b3057bb?w=800&q=80', // Modern house
            'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800&q=80', // Beach house
            'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&q=80', // Luxury interior
            'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&q=80', // Modern living room
        ];

        $properties = Property::all();

        foreach ($properties as $index => $property) {
            // Jika property belum punya image, tambahkan
            if (!$property->image) {
                try {
                    // Ambil gambar dari URL
                    $imageUrl = $imageUrls[$index % count($imageUrls)];
                    $imageContent = Http::get($imageUrl)->body();
                    
                    // Simpan gambar
                    $filename = 'property_' . $property->id . '_' . time() . '.jpg';
                    Storage::disk('public')->put('properties/' . $filename, $imageContent);
                    
                    // Update property dengan nama file
                    $property->update(['image' => 'properties/' . $filename]);
                    
                    $this->command->info("Gambar ditambahkan untuk: {$property->title}");
                } catch (\Exception $e) {
                    $this->command->error("Error pada property {$property->id}: " . $e->getMessage());
                }
            }
        }

        $this->command->info('Semua properties sudah memiliki gambar!');
    }
}