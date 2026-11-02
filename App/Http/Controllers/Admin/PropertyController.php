<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    // Daftar properti
    public function index()
    {
        $properties = Property::with('category', 'user')
            ->when(request('search'), function($q) {
                $q->where('title', 'like', '%' . request('search') . '%');
            })
            ->when(request('category'), function($q) {
                $q->where('category_id', request('category'));
            })
            ->when(request('status'), function($q) {
                $q->where('status', request('status'));
            })
            ->latest()
            ->paginate(15);
        
        $categories = Category::all();
        
        return view('admin.properties.index', compact('properties', 'categories'));
    }

    // Form tambah properti
public function create()
{
    $categories = \App\Models\Category::all(); // ← INI HARUS ADA
    
    $facilities = [
        'AC', 'Kolam Renang', 'Gym', 'Parkir', 'Security 24/7', 
        'Taman', 'Internet', 'Dapur Modern', 'Smart Home'
    ];
    
    return view('admin.properties.create', compact('categories', 'facilities'));
    //                                           ↑ INI PENTING!
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive,sold,rented',
            'price' => 'required|numeric|min:0',
            'listing_type' => 'required|in:sale,rent',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'district' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'land_size' => 'nullable|numeric|min:0',
            'building_size' => 'nullable|numeric|min:0',
            'floors' => 'nullable|integer|min:0',
            'garages' => 'nullable|integer|min:0',
            'electricity' => 'nullable|string',
            'certificate' => 'nullable|string',
            'description' => 'required|string|min:10',
            'negotiable' => 'nullable|boolean',
        ]);

        // Handle multiple images
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $images[] = $path;
            }
        }

        $validated['images'] = $images;
        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($request->title);
        $validated['featured'] = $request->has('featured') ? 1 : 0;
        $validated['negotiable'] = $request->has('negotiable') ? 1 : 0;

        // Handle facilities (array of strings, bukan key-value)
        if ($request->has('facilities')) {
            $facilities = [];
            foreach ($request->input('facilities') as $facility => $value) {
                if ($value === '1') {
                    $facilities[] = $facility;
                }
            }
            $validated['facilities'] = $facilities;
        }

        Property::create($validated);

        return redirect()->route('admin.properties.index')
                       ->with('success', 'Properti berhasil ditambahkan!');
    }

    // Tampilkan detail properti (admin)
    public function show(Property $property)
    {
        $property->load('category', 'user');
        return view('admin.properties.show', compact('property'));
    }

    // Form edit properti
    public function edit(Property $property)
{
    $categories = Category::all();
    $facilities = [
        'AC', 'Kolam Renang', 'Gym', 'Parkir', 'Security 24/7', 
        'Taman', 'Internet', 'Dapur Modern', 'Smart Home'
    ];
    
    return view('admin.properties.edit', compact('property', 'categories', 'facilities'));
}

    // Update properti
    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive,sold,rented',
            'price' => 'required|numeric|min:0',
            'listing_type' => 'required|in:sale,rent',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'district' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'land_size' => 'nullable|numeric|min:0',
            'building_size' => 'nullable|numeric|min:0',
            'floors' => 'nullable|integer|min:0',
            'garages' => 'nullable|integer|min:0',
            'electricity' => 'nullable|string',
            'certificate' => 'nullable|string',
            'description' => 'required|string|min:10',
        ]);

        // Handle delete images
        if ($request->has('delete_images')) {
            $images = $property->images ?? [];
            foreach ($request->input('delete_images') as $imagePath) {
                Storage::disk('public')->delete($imagePath);
                $images = array_filter($images, function($img) use ($imagePath) {
                    return $img !== $imagePath;
                });
            }
            $validated['images'] = array_values($images);
        }

        // Handle new images
        if ($request->hasFile('images')) {
            $images = $property->images ?? [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $images[] = $path;
            }
            $validated['images'] = $images;
        }

        // Handle facilities
        if ($request->has('facilities')) {
            $facilities = [];
            foreach ($request->input('facilities') as $facility => $value) {
                if ($value === '1') {
                    $facilities[] = $facility;
                }
            }
            $validated['facilities'] = $facilities;
        }

        $validated['slug'] = Str::slug($request->title);
        $validated['featured'] = $request->has('featured') ? 1 : 0;
        $validated['negotiable'] = $request->has('negotiable') ? 1 : 0;

        $property->update($validated);

        return redirect()->route('admin.properties.index')
                       ->with('success', 'Properti berhasil diupdate!');
    }

    // Hapus properti
    public function destroy(Property $property)
    {
        // Delete images
        if ($property->images && count($property->images) > 0) {
            foreach ($property->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $property->delete();

        return redirect()->route('admin.properties.index')
                       ->with('success', 'Properti berhasil dihapus!');
    }
}