<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->withCount(['properties' => function($query) {
                $query->where('status', 'active');
            }])
            ->orderBy('order')
            ->get();

        // For each category, load a few featured properties
        foreach ($categories as $category) {
            $category->properties = $category->properties()
                ->where('status', 'active')
                ->where('featured', true)
                ->with(['category'])
                ->take(4)
                ->get();
        }

        $faqs = FAQ::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('contact', compact('faqs'));
    
    }

    public function submit(Request $request)
    {
        // 1. Cek apakah User Login?
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to send a message.');
        }

        $user = Auth::user();

        // 2. Validasi input (Hanya Subject & Message, karena Nama/Email ambil dari Auth)
        $request->validate([
            'subject' => 'nullable|string|max:255', // Bisa kosong (nanti kita kasih default)
            'message' => 'required|string|min:5',
        ]);

        try {
            // 3. Simpan ke tabel 'inquiries'
            Inquiry::create([
                'user_id'     => $user->id,
                'name'        => $user->name,
                'email'       => $user->email,
                'phone'       => $user->phone ?? null, // Ambil no hp user jika ada
                'subject'     => $request->subject ?? 'General Inquiry', // Default subject jika kosong
                'message'     => $request->message,
                'status'      => 'new', // Status awal pesan
                'property_id' => null, // Null karena ini pesan dari halaman Contact Us
            ]);
            
            return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully. We will contact you soon.');
            
        } catch (\Exception $e) {
            // Debugging: Boleh dihapus nanti
            // dd($e->getMessage()); 
            
            return redirect()->back()->with('error', 'Failed to send message. Please try again.');
        }
    }

    public function show(Category $category, Request $request)
    {
        // Get properties for this category
        $query = $category->properties()
            ->where('status', 'active')
            ->with(['category']);

        // Apply filters
        if ($request->filled('listing_type')) {
            $query->where('listing_type', $request->listing_type);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Apply sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'featured':
                $query->orderBy('featured', 'desc')->orderBy('created_at', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        // Paginate with 12 items per page
        $properties = $query->paginate(12)->withQueryString();

        // Stats for this category
        $stats = [
            'total' => $category->properties()->where('status', 'active')->count(),
            'for_sale' => $category->properties()->where('status', 'active')->where('listing_type', 'sale')->count(),
            'for_rent' => $category->properties()->where('status', 'active')->where('listing_type', 'rent')->count(),
            'featured' => $category->properties()->where('status', 'active')->where('featured', true)->count(),
        ];

        // Get all categories for sidebar
        $allCategories = Category::where('is_active', true)
            ->withCount(['properties' => function($query) {
                $query->where('status', 'active');
            }])
            ->orderBy('order')
            ->get();

        return view('categories.show', compact('category', 'properties', 'stats', 'allCategories'));
    }
}