<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserInquiryController; // <--- Pastikan ini ada
use App\Models\Property;
use App\Models\Category;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\InquiryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES (Bisa diakses siapa saja) ---

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/', function () {
    // AMBIL DATA PROPERTI DARI DATABASE
    // Kita ambil 3 properti terbaru yang statusnya 'active'
    // Jika Anda punya kolom 'is_featured', Anda bisa tambahkan ->where('is_featured', true)
    $featuredProperties = Property::with('category')
                            ->where('status', 'active')
                            ->latest() // Urutkan dari yang paling baru ditambahkan
                            ->take(3)  // Ambil cuma 3 (sesuai layout grid di gambar)
                            ->get();

    // Kirim variabel $featuredProperties ke view 'welcome'
    return view('welcome', compact('featuredProperties'));
})->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');

// Contact Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// --- ROUTE BARU: LIST YOUR PROPERTY (USER) ---
// Ini yang bikin tombol List Property bekerja
Route::get('/sell-property', function () {
    return view('user.sell'); // Pastikan file resources/views/user/sell.blade.php ada
})->name('sell.property');
// ---------------------------------------------

// Halaman Listing Property (Public)
Route::get('/properties', function () {
    $query = Property::query()->with('category');

    if (request('category') && request('category') != '') {
        $query->whereHas('category', function($q) {
            $q->where('id', request('category'));
        });
    }
    if (request('search')) {
        $searchTerm = request('search');
        $query->where(function($q) use ($searchTerm) {
            $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('city', 'like', '%' . $searchTerm . '%');
        });
    }

    $query->where('status', 'active'); // Hanya tampilkan yang aktif
    $properties = $query->paginate(12);
    $categories = Category::where('is_active', true)->get();

    return view('properties.index', compact('properties', 'categories'));
})->name('properties.index');

// Halaman Detail Property (Public)
Route::get('/properties/{id}', function ($id) {
    $property = Property::with('category')->findOrFail($id);
    $relatedProperties = Property::where('category_id', $property->category_id)
        ->where('id', '!=', $id)
        ->with('category')
        ->limit(3)
        ->get();
    
    return view('properties.show', compact('property', 'relatedProperties'));
})->name('properties.show');

// Categories Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('category.show.slug');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');


// --- ADMIN ROUTES (Hanya Admin) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('properties', PropertyController::class);

    // Inquiries (Pesan Masuk)
    Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{id}', [InquiryController::class, 'show'])->name('inquiries.show');
    Route::delete('/inquiries/{id}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');
    Route::post('/inquiries/{id}/status', [InquiryController::class, 'updateStatus'])->name('inquiries.update-status');
    Route::post('/inquiries/{id}/notes', [InquiryController::class, 'addNotes'])->name('inquiries.add-notes');

    Route::get('/settings', function() { return "Halaman Pengaturan"; })->name('settings.index');
});


// --- USER DASHBOARD & ROUTES (User Biasa) ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard User
    Route::get('/dashboard', function () {
        $statuses = ['active', 'sold', 'rented'];
        $featuredProperties = Property::where('featured', true)->whereIn('status', $statuses)->take(6)->get();
        $latestProperties = Property::whereIn('status', $statuses)->latest()->take(8)->get();
        $categories = Category::where('is_active', true)->take(8)->get();
        return view('dashboard', compact('featuredProperties', 'categories', 'latestProperties'));
    })->name('dashboard');

    // My Inquiries (Halaman Balasan Admin)
    Route::get('/my-inquiries', [UserInquiryController::class, 'index'])->name('my-inquiries');
});


// --- PROFILE ROUTES ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Login Admin (Optional)
Route::get('/admin/login', function () {
    return view('auth.admin-login');
})->name('admin.login');

require __DIR__.'/auth.php';