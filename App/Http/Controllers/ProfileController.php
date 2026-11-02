<?php

namespace App\Http\Controllers; 

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Property;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with(['category', 'user']);

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        $properties = $query->latest()->paginate(10);
        $categories = Category::where('is_active', true)->get();

        return view('admin.properties.index', compact('properties', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $agents = User::all();
        
        $facilities = [
            'AC', 'Swimming Pool', 'Security 24jam', 'Parkir Mobil', 'Parkir Motor',
            'Taman', 'Gym', 'CCTV', 'Internet', 'Listrik Prabayar',
            'Air PAM', 'Sumur Bor', 'Water Heater', 'Kitchen Set', 'Gardu Listrik'
        ];
        
        return view('admin.properties.create', compact('categories', 'agents', 'facilities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,sold,rented,inactive',
        ]);

        $validated['user_id'] = auth()->id();
        Property::create($validated);

        return redirect()->route('admin.properties.index')
                        ->with('success', 'Properti berhasil ditambahkan');
    }

    public function show(Property $property)
    {
        return view('admin.properties.show', compact('property'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

     public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$request->user()->id],
        ]);

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}