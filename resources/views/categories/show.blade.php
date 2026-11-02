@extends('layouts.app')

@section('title', $category->name . ' Properties - Luxury Real Estate')
@section('meta_description', 'Discover exclusive ' . $category->name . ' properties. ' . $category->description)

@section('content')
<div class="bg-black min-h-screen">
    <!-- Header Section -->
    <section class="relative py-16 bg-gradient-to-r from-black via-gray-900 to-black border-b border-gray-800">
        <div class="container mx-auto px-4">
            <!-- Breadcrumb -->
            <div class="mb-8 flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-yellow-500 transition">Home</a>
                <span class="text-gray-600">/</span>
                <a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-yellow-500 transition">Categories</a>
                <span class="text-gray-600">/</span>
                <span class="text-yellow-500">{{ $category->name }}</span>
            </div>

            <!-- Category Info -->
            <div class="flex items-start justify-between gap-8">
                <div>
                    <div class="text-6xl mb-6">{{ $category->icon ?? '🏠' }}</div>
                    <h1 class="text-5xl font-bold text-white mb-4">
                        {{ $category->name }}
                    </h1>
                    <p class="text-xl text-gray-300 max-w-2xl">
                        {{ $category->description ?? 'Discover our exclusive collection of ' . strtolower($category->name) . ' properties' }}
                    </p>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4 min-w-max">
                    <div class="bg-gray-900 border border-gray-800 rounded-lg p-6 text-center">
                        <div class="text-3xl font-bold text-yellow-500 mb-2">{{ $stats['total'] }}</div>
                        <div class="text-gray-400 text-sm">Total Properties</div>
                    </div>
                    <div class="bg-gray-900 border border-gray-800 rounded-lg p-6 text-center">
                        <div class="text-3xl font-bold text-green-500 mb-2">{{ $stats['for_sale'] }}</div>
                        <div class="text-gray-400 text-sm">For Sale</div>
                    </div>
                    <div class="bg-gray-900 border border-gray-800 rounded-lg p-6 text-center">
                        <div class="text-3xl font-bold text-blue-500 mb-2">{{ $stats['for_rent'] }}</div>
                        <div class="text-gray-400 text-sm">For Rent</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="bg-black py-8 border-b border-gray-800">
        <div class="container mx-auto px-4">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Listing Type Filter -->
                <div>
                    <select name="listing_type" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 text-white rounded-lg focus:outline-none focus:border-yellow-500 transition">
                        <option value="">All Types (Sale & Rent)</option>
                        <option value="sale" {{ request('listing_type') == 'sale' ? 'selected' : '' }}>For Sale</option>
                        <option value="rent" {{ request('listing_type') == 'rent' ? 'selected' : '' }}>For Rent</option>
                    </select>
                </div>

                <!-- Min Price -->
                <div>
                    <input type="number" name="min_price" placeholder="Min Price" 
                           value="{{ request('min_price') }}"
                           class="w-full px-4 py-3 bg-gray-900 border border-gray-700 text-white placeholder-gray-500 rounded-lg focus:outline-none focus:border-yellow-500 transition">
                </div>

                <!-- Max Price -->
                <div>
                    <input type="number" name="max_price" placeholder="Max Price" 
                           value="{{ request('max_price') }}"
                           class="w-full px-4 py-3 bg-gray-900 border border-gray-700 text-white placeholder-gray-500 rounded-lg focus:outline-none focus:border-yellow-500 transition">
                </div>

                <!-- Sort -->
                <div>
                    <select name="sort" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 text-white rounded-lg focus:outline-none focus:border-yellow-500 transition">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                        <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                </div>

                <!-- Filter Buttons -->
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 px-6 py-3 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-400 transition">
                        Filter
                    </button>
                    <a href="{{ route('category.show', $category->slug) }}" class="flex-1 px-6 py-3 bg-gray-800 text-white font-bold rounded-lg hover:bg-gray-700 transition text-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </section>

    <!-- Properties Grid -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            @if($properties->count() > 0)
                <!-- Results Count -->
                <div class="mb-8 flex items-center justify-between">
                    <p class="text-gray-400">
                        Showing <span class="text-yellow-500 font-bold">{{ $properties->count() }}</span> of 
                        <span class="text-yellow-500 font-bold">{{ $stats['total'] }}</span> properties
                    </p>
                </div>

                <!-- Properties Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    @foreach($properties as $property)
                        <div class="group bg-gray-900 border border-gray-700 rounded-lg overflow-hidden hover:border-yellow-500 transition duration-300">
                            <!-- Image -->
                            <div class="relative h-72 overflow-hidden bg-gray-800">
                                @if($property->images && count($property->images) > 0)
                                    <img src="{{ asset('storage/' . $property->images[0]) }}" alt="{{ $property->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-image text-4xl text-gray-700"></i>
                                    </div>
                                @endif

                                <!-- Badges -->
                                <div class="absolute top-4 left-4 flex gap-2 z-10">
                                    <span class="bg-black/70 backdrop-blur-sm text-yellow-400 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-yellow-500/30">
                                        {{ $category->name }}
                                    </span>
                                </div>

                                <!-- Status Badge -->
                                <div class="absolute top-4 right-4 z-10">
                                    @php
                                        $statusColor = match(strtolower($property->listing_type)) {
                                            'rent', 'tersewa' => 'bg-blue-600 text-white',
                                            default => 'bg-green-600 text-white',
                                        };
                                    @endphp
                                    <span class="{{ $statusColor }} text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-md">
                                        {{ ucfirst($property->listing_type) }}
                                    </span>
                                </div>

                                <!-- Featured Badge -->
                                @if($property->featured)
                                    <div class="absolute bottom-4 left-4 bg-yellow-500 text-black text-xs font-bold px-3 py-1 rounded-full uppercase">
                                        ⭐ Featured
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="mb-3">
                                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-yellow-500 transition line-clamp-2">
                                        {{ $property->title }}
                                    </h3>
                                    <p class="text-gray-400 text-sm flex items-center gap-1">
                                        <i class="fas fa-map-marker-alt text-yellow-500"></i>
                                        {{ $property->city }}, {{ $property->province ?? 'Indonesia' }}
                                    </p>
                                </div>

                                <!-- Description -->
                                <p class="text-gray-400 text-sm mb-4 line-clamp-2 border-t border-gray-700 pt-3">
                                    {{ $property->description }}
                                </p>

                                <!-- Features -->
                                <div class="flex gap-4 mb-4 text-gray-400 text-sm border-t border-gray-700 pt-3">
                                    @if($property->bedrooms)
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-bed text-yellow-500"></i>
                                            {{ $property->bedrooms }} Bed
                                        </div>
                                    @endif
                                    @if($property->bathrooms)
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-bath text-yellow-500"></i>
                                            {{ $property->bathrooms }} Bath
                                        </div>
                                    @endif
                                    @if($property->building_size)
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-ruler text-yellow-500"></i>
                                            {{ $property->building_size }} m²
                                        </div>
                                    @endif
                                </div>

                                <!-- Price and Button -->
                                <div class="flex items-center justify-between pt-3 border-t border-gray-700">
                                    <div>
                                        <div class="text-2xl font-bold text-yellow-500">
                                            Rp {{ number_format($property->price, 0, ',', '.') }}
                                        </div>
                                        @if($property->listing_type == 'rent')
                                            <div class="text-xs text-gray-400">/year</div>
                                        @endif
                                    </div>
                                    <a href="{{ route('properties.show', $property->id) }}" class="px-4 py-2 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-400 transition transform hover:scale-105 duration-200">
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
                <!-- No Properties -->
                <div class="text-center py-20">
                    <div class="text-6xl mb-6 opacity-50">🔍</div>
                    <h3 class="text-2xl font-bold text-white mb-4">No Properties Found</h3>
                    <p class="text-gray-400 mb-8">
                        Try adjusting your filters or browse other categories
                    </p>
                    <div class="flex gap-4 justify-center">
                        <a href="{{ route('category.show', $category->slug) }}" class="px-6 py-3 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-400 transition">
                            Reset Filters
                        </a>
                        <a href="{{ route('categories.index') }}" class="px-6 py-3 bg-gray-800 text-white font-bold rounded-lg hover:bg-gray-700 transition">
                            Back to Categories
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Related Categories -->
    <section class="py-16 bg-gray-900/50 border-t border-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-white mb-12 text-center">
                Explore Other <span class="text-yellow-500">Categories</span>
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($allCategories as $cat)
                    @if($cat->id !== $category->id && $cat->properties_count > 0)
                        <a href="{{ route('category.show', $cat->slug) }}" 
                           class="group p-6 bg-black border border-gray-800 rounded-lg hover:border-yellow-500/50 hover:bg-gray-900 transition-all text-center">
                            <div class="text-4xl mb-3">{{ $cat->icon ?? '🏠' }}</div>
                            <h3 class="font-bold text-white group-hover:text-yellow-500 transition mb-2">{{ $cat->name }}</h3>
                            <p class="text-gray-400 text-sm">{{ $cat->properties_count }} properties</p>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection