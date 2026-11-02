<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Daftar kategori
    public function index()
    {
        $categories = Category::withCount('properties')->latest()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    // Form tambah kategori
    public function create()
    {
        return view('admin.categories.create');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($request->name);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        Category::create($validated);

        return redirect()->route('admin.categories.index')
                       ->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Form edit kategori
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Update kategori
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($request->name);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $category->update($validated);

        return redirect()->route('admin.categories.index')
                       ->with('success', 'Kategori berhasil diupdate!');
    }

    // Hapus kategori
    public function destroy(Category $category)
    {
        // Cek apakah kategori masih punya properti
        if ($category->properties()->count() > 0) {
            return redirect()->back()
                           ->with('error', 'Tidak bisa hapus kategori yang masih memiliki properti!');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
                       ->with('success', 'Kategori berhasil dihapus!');
    }
}