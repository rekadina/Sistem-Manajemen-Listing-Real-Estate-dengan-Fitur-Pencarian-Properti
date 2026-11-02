@extends('layouts.app')

@section('title', 'Luxury Properties - Browse Exclusive Listings')
@section('meta_description', 'Browse our exclusive collection of luxury properties for sale and rent. Find your dream home in premium locations.')

@push('styles')
<style>
    /* Price Range Slider */
    .price-slider {
        -webkit-appearance: none;
        width: 100%;
        height: 4px;
        background: #4B5563;
        border-radius: 2px;
        outline: none;
    }
    
    .price-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background: #D4AF37;
        border-radius: 50%;
        cursor: pointer;
    }
    
    .price-slider::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: #D4AF37;
        border-radius: 50%;
        cursor: pointer;
        border: none;
    }
    
    /* Checkbox Styling */
    .filter-checkbox {
        appearance: none;
        width: 18px;
        height: 18px;
        border: 2px solid #4B5563;
        border-radius: 4px;
        background-color: transparent;
        cursor: pointer;
        position: relative;
    }
    
    .filter-checkbox:checked {
        background-color: #D4AF37;
        border-color: #D4AF37;
    }
    
    .filter-checkbox:checked::after {
        content: '✓';
        position: absolute;
        color: #000000;
        font-size: 12px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    /* Property Card Hover Effects */
    .property-card {
        transition: all 0.3s ease;
        background: linear-gradient(145deg, #1a1a1a, #2B2B2B);
    }
    
    .property-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(212, 175, 55, 0.1);
    }
</style>
@endpush

@section('content')
<div class="pt-8 pb-20">
    <div class="container mx-auto px-4">
        <!-- Page Header -->
        <div class="mb-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Exclusive <span class="gold-gradient">Properties</span></h1>
            <p class="text-gray-400 text-lg">Discover our curated collection of luxury real estate</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <div class="lg:w-1/4">
                <div class="luxury-card p-6 rounded-2xl sticky top-24">
                    <!-- Filters Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold">Filters</h3>
                        <button onclick="resetFilters()" class="text-sm text-gold hover:text-yellow-400">
                            Reset All
                        </button>
                    </div>

                    <!-- Search Form -->
                    <form action="{{ route('properties.index') }}" method="GET" id="property-filters">
                        <!-- Keyword Search -->
                        <div class="mb-6">
                            <label class="block text-gray-400 text-sm mb-2">Search</label>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Enter keywords..."
                                   class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-gold">
                        </div>

                        <!-- Property Type -->
                        <div class="mb-6">
                            <label class="block text-gray-400 text-sm mb-3">Property Type</label>
                            <div class="space-y-2">
                                @foreach($categories as $category)
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                           {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                           class="filter-checkbox mr-3">
                                    <span class="text-white">{{ $category->name }}</span>
                                    <span class="ml-auto text-gray-400 text-sm">{{ $category->properties_count }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Listing Type -->
                        <div class="mb-6">
                            <label class="block text-gray-400 text-sm mb-3">Listing Type</label>
                            <div class="space-y-2">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="listing_type" value="sale" 
                                           {{ request('listing_type') == 'sale' ? 'checked' : '' }}
                                           class="filter-checkbox mr-3">
                                    <span class="text-white">For Sale</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="listing_type" value="rent" 
                                           {{ request('listing_type') == 'rent' ? 'checked' : '' }}
                                           class="filter-checkbox mr-3">
                                    <span class="text-white">For Rent</span>
                                </label>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="mb-6">
                            <label class="block text-gray-400 text-sm mb-2">Location</label>
                            <select name="location" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-gold">
                                <option value="">Any Location</option>
                                @php
                                    $locations = \App\Models\Property::select('city', 'province')
                                        ->whereNotNull('city')
                                        ->groupBy('city', 'province')
                                        ->get();
                                @endphp
                                @foreach($locations as $location)
                                <option value="{{ $location->city }}" {{ request('location') == $location->city ? 'selected' : '' }}>
                                    {{ $location->city }}, {{ $location->province }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-6">
                            <label class="block text-gray-400 text-sm mb-2">
                                Price Range: <span id="price-value" class="text-gold">${{ number_format(request('min_price', 0) / 1000000, 1) }}M - ${{ number_format(request('max_price', 10000000) / 1000000, 1) }}M</span>
                            </label>
                            <div class="space-y-4">
                                <div class="flex space-x-4">
                                    <input type="number" name="min_price" value="{{ request('min_price', 0) }}" 
                                           placeholder="Min Price" 
                                           class="flex-1 bg-gray-900 border border-gray-700 rounded-lg px-3 py-2 text-white text-sm">
                                    <input type="number" name="max_price" value="{{ request('max_price', 10000000) }}" 
                                           placeholder="Max Price" 
                                           class="flex-1 bg-gray-900 border border-gray-700 rounded-lg px-3 py-2 text-white text-sm">
                                </div>
                                <input type="range" min="0" max="50000000" step="1000000" 
                                       value="{{ request('max_price', 10000000) }}" 
                                       oninput="updatePriceSlider(this.value)"
                                       class="price-slider">
                            </div>
                        </div>

                        <!-- Bedrooms -->
                        <div class="mb-6">
                            <label class="block text-gray-400 text-sm mb-2">Bedrooms</label>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" onclick="setBedrooms(0)" 
                                        class="px-3 py-2 rounded-lg {{ request('bedrooms') == '0' ? 'bg-gold text-black' : 'bg-gray-900 text-white' }}">
                                    Any
                                </button>
                                @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setBedrooms({{ $i }})" 
                                        class="px-3 py-2 rounded-lg {{ request('bedrooms') == $i ? 'bg-gold text-black' : 'bg-gray-900 text-white' }}">
                                    {{ $i }}+
                                </button>
                                @endfor
                            </div>
                            <input type="hidden" name="bedrooms" id="bedrooms-input" value="{{ request('bedrooms') }}">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full bg-gold text-black font-semibold py-3 rounded-lg hover:bg-yellow-500 transition-colors">
                            Apply Filters
                        </button>
                    </form>
                </div>

                <!-- Quick Stats -->
                <div class="luxury-card p-6 rounded-2xl mt-6">
                    <h4 class="text-lg font-semibold mb-4">Quick Stats</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Total Properties</span>
                            <span class="text-gold font-semibold">{{ $properties->total() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">For Sale</span>
                            <span class="text-gold font-semibold">{{ $stats['for_sale'] ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">For Rent</span>
                            <span class="text-gold font-semibold">{{ $stats['for_rent'] ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Featured</span>
                            <span class="text-gold font-semibold">{{ $stats['featured'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Properties Grid -->
            <div class="lg:w-3/4">
                <!-- Filters Bar -->
                <div class="luxury-card p-4 rounded-xl mb-8">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="text-sm text-gray-400">
                            Showing <span class="text-gold font-semibold">{{ $properties->firstItem() ?? 0 }}-{{ $properties->lastItem() ?? 0 }}</span> 
                            of <span class="text-gold font-semibold">{{ $properties->total() }}</span> properties
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <!-- Sort By -->
                            <select onchange="this.form.submit()" name="sort" 
                                    class="bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white text-sm focus:outline-none focus:border-gold">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest First</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured First</option>
                            </select>

                            <!-- View Toggle -->
                            <div class="flex border border-gray-700 rounded-lg overflow-hidden">
                                <button type="button" onclick="setViewMode('grid')" 
                                        class="px-3 py-2 {{ $viewMode == 'grid' ? 'bg-gold text-black' : 'bg-gray-900 text-white' }}">
                                    <i class="fas fa-th"></i>
                                </button>
                                <button type="button" onclick="setViewMode('list')" 
                                        class="px-3 py-2 {{ $viewMode == 'list' ? 'bg-gold text-black' : 'bg-gray-900 text-white' }}">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Properties Grid/List -->
                @if($properties->count() > 0)
                    @if($viewMode == 'grid')
                    <!-- Grid View -->
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($properties as $property)
                        @include('properties.partials.card', ['property' => $property])
                        @endforeach
                    </div>
                    @else
                    <!-- List View -->
                    <div class="space-y-6">
                        @foreach($properties as $property)
                        <div class="luxury-card rounded-xl overflow-hidden">
                            <div class="flex flex-col md:flex-row">
                                <!-- Image -->
                                <div class="md:w-1/3">
                                        @php
                                            $imageUrl = isset($property->images[0]) ? Storage::url($property->images[0]) : 'URL_PLACEHOLDER_JIKA_GAMBAR_TIDAK_ADA';
                                        @endphp
                                            <img src="{{ $imageUrl }}" alt="{{ $property->title }}" class="w-full h-64 md:h-full object-cover"></div>
                                
                                <!-- Details -->
                                <div class="md:w-2/3 p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-xl font-semibold mb-2">{{ $property->title }}</h3>
                                            <p class="text-gray-400">
                                                <i class="fas fa-map-marker-alt text-gold mr-2"></i>
                                                {{ $property->city }}, {{ $property->province }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-2xl font-bold text-gold mb-2">${{ number_format($property->price / 1000000, 2) }}M</div>
                                            <span class="bg-gold/20 text-gold px-3 py-1 rounded-full text-xs">
                                                {{ ucfirst($property->listing_type) }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Features -->
                                    <div class="grid grid-cols-3 gap-4 mb-6">
                                        @if($property->bedrooms)
                                        <div class="text-center">
                                            <div class="text-gray-400 text-sm">Bedrooms</div>
                                            <div class="text-white font-semibold">{{ $property->bedrooms }}</div>
                                        </div>
                                        @endif
                                        
                                        @if($property->bathrooms)
                                        <div class="text-center">
                                            <div class="text-gray-400 text-sm">Bathrooms</div>
                                            <div class="text-white font-semibold">{{ $property->bathrooms }}</div>
                                        </div>
                                        @endif
                                        
                                        @if($property->land_size)
                                        <div class="text-center">
                                            <div class="text-gray-400 text-sm">Area</div>
                                            <div class="text-white font-semibold">{{ $property->land_size }} m²</div>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Actions -->
                                    <div class="flex justify-between items-center">
                                        <div class="text-sm text-gray-400">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ $property->created_at->diffForHumans() }}
                                        </div>
                                        <a href="{{ route('properties.show', $property) }}" 
                                           class="border border-gold text-gold px-6 py-2 rounded-lg hover:bg-gold hover:text-black transition-colors">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Pagination -->
                    @if($properties->hasPages())
                    <div class="mt-12">
                        {{ $properties->links('vendor.pagination.custom') }}
                    </div>
                    @endif
                @else
                <!-- No Results -->
                <div class="luxury-card p-12 rounded-2xl text-center">
                    <div class="w-20 h-20 bg-gold/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-gold text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">No Properties Found</h3>
                    <p class="text-gray-400 mb-8">Try adjusting your search filters or browse all properties.</p>
                    <a href="{{ route('properties.index') }}" 
                       class="inline-block bg-gold text-black px-6 py-3 rounded-lg hover:bg-yellow-500 transition-colors">
                        Browse All Properties
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Price slider update
    function updatePriceSlider(value) {
        const maxPriceInput = document.querySelector('input[name="max_price"]');
        maxPriceInput.value = value;
        updatePriceDisplay();
    }
    
    function updatePriceDisplay() {
        const minPrice = document.querySelector('input[name="min_price"]').value || 0;
        const maxPrice = document.querySelector('input[name="max_price"]').value || 10000000;
        const priceValue = document.getElementById('price-value');
        priceValue.textContent = `$${(minPrice/1000000).toFixed(1)}M - $${(maxPrice/1000000).toFixed(1)}M`;
    }
    
    // Bedrooms filter
    function setBedrooms(value) {
        document.getElementById('bedrooms-input').value = value;
        document.getElementById('property-filters').submit();
    }
    
    // View mode
    function setViewMode(mode) {
        localStorage.setItem('property_view_mode', mode);
        document.getElementById('property-filters').submit();
    }
    
    // Reset filters
    function resetFilters() {
        window.location.href = "{{ route('properties.index') }}";
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updatePriceDisplay();
        
        // Set initial view mode
        const savedViewMode = localStorage.getItem('property_view_mode') || 'grid';
        if (savedViewMode === 'list') {
            document.querySelector('button[onclick="setViewMode(\'list\')"]').click();
        }
    });
</script>
@endpush