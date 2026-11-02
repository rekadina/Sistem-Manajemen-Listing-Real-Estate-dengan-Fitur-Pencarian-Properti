@extends('layouts.app')

@section('content')
<div class="bg-black min-h-screen">
    <!-- Header Section -->
    <div class="bg-black border-b border-gray-700 py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-white mb-2">Our Luxury Properties</h1>
            <p class="text-gray-400 text-lg">Discover exceptional properties tailored to your lifestyle</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-black py-8 border-b border-gray-700">
        <div class="container mx-auto px-4">
            <form method="GET" action="{{ route('properties.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Search -->
                <div>
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search properties..." 
                        value="{{ request('search') }}"
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-700 text-white placeholder-gray-500 rounded-lg focus:outline-none focus:border-yellow-400 transition"
                    >
                </div>

                <!-- Category Filter -->
                <div>
                    <select 
                        name="category"
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-700 text-white rounded-lg focus:outline-none focus:border-yellow-400 transition"
                    >
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Location Filter -->
                <div>
                    <input 
                        type="text" 
                        name="location" 
                        placeholder="Location..." 
                        value="{{ request('location') }}"
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-700 text-white placeholder-gray-500 rounded-lg focus:outline-none focus:border-yellow-400 transition"
                    >
                </div>

                <!-- Price Min -->
                <div>
                    <input 
                        type="number" 
                        name="price_min" 
                        placeholder="Min Price" 
                        value="{{ request('price_min') }}"
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-700 text-white placeholder-gray-500 rounded-lg focus:outline-none focus:border-yellow-400 transition"
                    >
                </div>

                <!-- Price Max -->
                <div>
                    <input 
                        type="number" 
                        name="price_max" 
                        placeholder="Max Price" 
                        value="{{ request('price_max') }}"
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-700 text-white placeholder-gray-500 rounded-lg focus:outline-none focus:border-yellow-400 transition"
                    >
                </div>

                <!-- Filter Button -->
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 px-6 py-3 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-400 transition">
                        Filter
                    </button>
                    <a href="{{ route('properties.index') }}" class="flex-1 px-6 py-3 bg-gray-700 text-white font-bold rounded-lg hover:bg-gray-600 transition text-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Properties Grid -->
    <div class="bg-black py-16">
        <div class="container mx-auto px-4">
            @if($properties->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    @foreach($properties as $property)
                        <div class="group bg-gray-900 border border-gray-700 rounded-lg overflow-hidden hover:border-yellow-500 transition duration-300">
                            <!-- Image -->
                            <div class="group relative bg-gray-900 rounded-xl overflow-hidden border border-gray-800 hover:border-yellow-600/50 transition-all duration-500 hover:shadow-2xl hover:shadow-yellow-900/10">
                                <div class="relative h-72 overflow-hidden">
                                    <div class="absolute top-4 left-4 z-10">
                                        <span class="bg-black/70 backdrop-blur-sm text-yellow-400 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-yellow-500/30">
                                            {{ $property->category->name ?? 'Exclusive' }}
                                        </span>
                                    </div>
                                    <div class="absolute top-4 right-4 z-10">
                                         @php
                                                // Logika warna sederhana berdasarkan status
                                                $statusColor = match(strtolower($property->status)) {
                                                'sold', 'terjual' => 'bg-red-600 text-white',
                                                'rented', 'tersewa' => 'bg-blue-600 text-white',
                                                default => 'bg-green-600 text-white', // Default untuk 'For Sale' / 'Tersedia'
                                            };
                                        @endphp
                                            <span class="{{ $statusColor }} text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-md">
                                                {{ $property->status }}
                                                </span>
        </div>

        <a href="{{ route('properties.show', $property->id) }}" class="block w-full h-full">
             @if($property->images && count($property->images) > 0)
                <img src="{{ asset('storage/' . $property->images[0]) }}" alt="{{ $property->title }}" 
                    class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 ease-in-out">
            @else
                @endif
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-80"></div>
        </a>
    </div>

    </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-yellow-500 text-sm font-semibold">{{ $property->category->name ?? 'Uncategorized' }}</span>
                                    <span class="text-gray-400 text-sm">{{ $property->location }}</span>
                                </div>

                                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-yellow-500 transition">
                                    {{ $property->title }}
                                </h3>

                                <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                                    {{ $property->description }}
                                </p>

                                <!-- Features -->
                                <div class="flex gap-4 mb-4 text-gray-400 text-sm border-t border-gray-700 pt-4">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5"></path>
                                        </svg>
                                        {{ $property->bedrooms }} Beds
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm12 4a2 2 0 012 2v4a2 2 0 01-2 2h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-1.414 0l-2.414-2.414A1 1 0 006.586 16H4a2 2 0 01-2-2v-4a2 2 0 012-2h12z"></path>
                                        </svg>
                                        {{ $property->bathrooms }} Baths
                                    </div>
                                    <div class="flex items-center gap-1">
                                        {{ $property->area }} m²
                                    </div>
                                </div>

                                <!-- Price and Button -->
                                <div class="flex items-center justify-between">
                                    <div class="text-2xl font-bold text-yellow-500">
                                        Rp {{ number_format($property->price, 0, ',', '.') }}
                                    </div>
                                    <a href="{{ route('properties.show', $property->id) }}" class="px-4 py-2 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-400 transition">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $properties->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg mb-4">No properties found matching your criteria.</p>
                    <a href="{{ route('properties.index') }}" class="inline-block px-6 py-3 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-400 transition">
                        View All Properties
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection