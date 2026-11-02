@extends('layouts.app')

@section('title', 'Luxury Real Estate - Premium Properties')
@section('meta_description', 'Discover exclusive luxury properties for sale and rent. Find your dream home in premium locations.')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-black via-black/80 to-transparent z-10"></div>
            <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" 
                 alt="Luxury Property" class="w-full h-full object-cover">
        </div>

        <div class="container mx-auto px-4 relative z-20">
            <div class="max-w-2xl animate-fadeInUp">
                {{-- Tambahkan text-white di sini --}}
<h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight text-white">
    Discover Your 
    <span class="gold-gradient">Dream Luxury</span> 
    Property
</h1>
                <p class="text-xl text-gray-300 mb-10">
                    Exclusive collection of premium real estate. From penthouses to waterfront villas, find properties that match your sophisticated lifestyle.
                </p>
                
                <!-- Search Form -->
                <div class="bg-dark-gray/90 backdrop-blur-sm p-8 rounded-2xl border border-gold/20">
    {{-- Tambahkan text-white di sini --}}
    <h3 class="text-2xl font-semibold mb-6 text-white">Find Your Luxury Property</h3>
                    <form action="{{ route('properties.index') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Location</label>
                                <select name="location" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-gold">
                                    <option value="">Any Location</option>
                                    <option value="beverly-hills">Beverly Hills</option>
                                    <option value="malibu">Malibu</option>
                                    <option value="miami">Miami</option>
                                    <option value="new-york">New York</option>
                                    <option value="dubai">Dubai</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Property Type</label>
                                <select name="type" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-gold">
                                    <option value="">Any Type</option>
                                    <option value="villa">Luxury Villa</option>
                                    <option value="apartment">Penthouse</option>
                                    <option value="mansion">Mansion</option>
                                    <option value="condo">Luxury Condo</option>
                                    <option value="commercial">Commercial</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Price Range</label>
                                <select name="price" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-gold">
                                    <option value="">Any Price</option>
                                    <option value="0-5000000">Up to $5M</option>
                                    <option value="5000000-10000000">$5M - $10M</option>
                                    <option value="10000000-20000000">$10M - $20M</option>
                                    <option value="20000000-50000000">$20M - $50M</option>
                                    <option value="50000000">$50M+</option>
                                </select>
                            </div>
                        </div>
                        
                       <button type="submit" 
    class="w-full bg-black text-white border border-gold font-semibold py-4 rounded-lg hover:bg-yellow-500 hover:text-black transition-colors duration-300 flex items-center justify-center space-x-2">
    <i class="fas fa-search"></i>
    <span>Search Luxury Properties</span>
</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Properties -->
    <section class="py-20 bg-black text-white"> 
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
    {{-- Solusi: Ganti jadi text-white --}}
    <span class="font-semibold tracking-widest uppercase">Exclusive Collection</span>

    <h2 class="text-4xl font-bold mt-4">
        Featured <span class="gold-gradient">Luxury Properties</span>
            </h2>
    <p class="text-gray-300 mt-4 max-w-2xl mx-auto">
                Handpicked selection of the most exclusive properties currently available
            </p>
</div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProperties as $property)
                <div class="luxury-card rounded-2xl overflow-hidden group">
                    <!-- Property Image -->
                    <div class="relative overflow-hidden h-64">
                        <img 
    src="{{ !empty($property->images) && isset($property->images[0]) ? asset('storage/' . $property->images[0]) : 'https://images.unsplash.com/photo-1613977257363-707ba9348227?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
    alt="{{ $property->title }}" 
    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1613977257363-707ba9348227?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';"
>
                        
                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex space-x-2">
                            @if($property->featured)
                            <span class="bg-gold text-black px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-crown mr-1"></i> Featured
                            </span>
                            @endif
                            <span class="bg-black/70 text-white px-3 py-1 rounded-full text-xs">
                                {{ ucfirst($property->listing_type) }}
                            </span>
                        </div>
                        
                        <!-- Price -->
                        <div class="absolute bottom-4 left-4 right-4">
    <div class="bg-black/80 backdrop-blur-sm p-4 rounded-lg">
        {{-- Solusi: Ganti jadi text-white --}}
        <span class="text-2xl font-bold text-white">${{ number_format($property->price / 1000000, 2) }}M</span>
    </div>
</div>
                    </div>

                    <!-- Property Details -->
                    <div class="p-6">
    {{-- Solusi: Tambahkan text-white --}}
    <h3 class="text-xl font-semibold mb-2 text-white group-hover:text-gold transition-colors">
        {{ $property->title }}
    </h3>
                        <p class="text-white mb-4">
        <i class="fas fa-map-marker-alt text-gold mr-2"></i>
        {{ $property->city }}, {{ $property->province }}
    </p>
                        
                        <!-- Features -->
                        <div class="flex justify-between text-sm text-white mb-6">
        @if($property->bedrooms)
        <div class="flex items-center">
            <i class="fas fa-bed text-gold mr-2"></i>
            <span>{{ $property->bedrooms }} Bed</span>
        </div>
        @endif
        
        @if($property->bathrooms)
        <div class="flex items-center">
            <i class="fas fa-bath text-gold mr-2"></i>
            <span>{{ $property->bathrooms }} Bath</span>
        </div>
        @endif
        
        @if($property->land_size)
        <div class="flex items-center">
            <i class="fas fa-ruler-combined text-gold mr-2"></i>
            <span>{{ $property->land_size }} m²</span>
        </div>
        @endif
    </div>
                        
                        <!-- View Details Button -->
                        <a href="{{ route('properties.show', $property) }}" 
       class="block w-full border border-gold text-white text-center py-3 rounded-lg hover:bg-gold hover:text-black transition-colors">
        View Details
    </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('properties.index') }}" 
                   class="inline-flex items-center space-x-2 text-gold hover:text-yellow-400 transition-colors">
                    <span>View All Properties</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>



    <!-- Property Categories -->
    <section class="py-20 bg-white text-gray-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="font-semibold tracking-widest uppercase">Exclusive Collection</span>
                <h2 class="text-4xl font-bold mt-4">
                    Featured <span class="gold-gradient">Luxury Properties</span>
                </h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($categories as $category)
                <a href="{{ route('categories.show', $category) }}" 
                   class="luxury-card p-8 rounded-2xl text-center group">
                    <div class="w-16 h-16 bg-gold/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-gold/20 transition-colors">
                        <span class="text-2xl">{{ $category->icon ?? '🏠' }}</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 group-hover:text-gold transition-colors">
                        {{ $category->name }}
                    </h3>
                    <p class="text-gray-300 mt-4 max-w-2xl mx-auto">
                    Handpicked selection of the most exclusive properties currently available
                </p>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats Section -->
   <section class="py-20 bg-black">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                {{-- Item 1: Total Properties --}}
                <div class="text-center">
                    {{-- UBAH DI SINI: ganti text-gold jadi text-white --}}
                    <div class="text-5xl font-bold text-white mb-4">{{ $stats['total_properties'] ?? '0' }}</div>
                    <div class="text-gray-400">Luxury Properties</div>
                </div>

                {{-- Item 2: Featured Listings --}}
                <div class="text-center">
                    {{-- UBAH DI SINI: ganti text-gold jadi text-white --}}
                    <div class="text-5xl font-bold text-white mb-4">{{ $stats['featured_properties'] ?? '0' }}</div>
                    <div class="text-gray-400">Featured Listings</div>
                </div>

                {{-- Item 3: Happy Clients --}}
                <div class="text-center">
                    {{-- UBAH DI SINI: ganti text-gold jadi text-white --}}
                    <div class="text-5xl font-bold text-white mb-4">{{ $stats['happy_clients'] ?? '500+' }}</div>
                    <div class="text-gray-400">Happy Clients</div>
                </div>

                {{-- Item 4: Years Experience --}}
                <div class="text-center">
                    {{-- UBAH DI SINI: ganti text-gold jadi text-white --}}
                    <div class="text-5xl font-bold text-white mb-4">{{ $stats['years_experience'] ?? '15+' }}</div>
                    <div class="text-gray-400">Years Experience</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Properties -->
    <section class="py-20 bg-dark-gray">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-12">
                <div>
                    <span class="text-gold font-semibold tracking-widest uppercase">New Arrivals</span>
                    <h2 class="text-4xl font-bold mt-2">Latest <span class="gold-gradient">Properties</span></h2>
                </div>
                <a href="{{ route('properties.index') }}" class="text-gold hover:text-yellow-400 transition-colors">
                    View All <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($latestProperties as $property)
                <div class="luxury-card rounded-xl overflow-hidden">
                    <div class="relative h-48">
                       <img 
    src="https://images.unsplash.com/photo-1600596542815-2a4d9f6fac90?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
    alt="Luxury Home" 
    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                        <div class="absolute top-3 right-3">
                            <span class="bg-black/70 text-white px-2 py-1 rounded text-xs">
                                {{ ucfirst($property->listing_type) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-5">
                        <h4 class="font-semibold mb-2 truncate">{{ $property->title }}</h4>
                        <p class="text-gray-400 text-sm mb-3">
                            <i class="fas fa-map-marker-alt text-gold mr-1"></i>
                            {{ $property->city }}
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-gold font-bold">${{ number_format($property->price / 1000000, 1) }}M</span>
                            <a href="{{ route('properties.show', $property) }}" class="text-gray-400 hover:text-gold">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-20 bg-black text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                {{-- UBAH: Ganti text-gold jadi text-white --}}
                <span class="text-white font-semibold tracking-widest uppercase">Simple Process</span>
                
                {{-- UBAH: Tambahkan text-white --}}
                <h2 class="text-4xl font-bold mt-4 text-white">How It <span class="gold-gradient">Works</span></h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 luxury-card">
                    {{-- TAMBAHKAN IKON INI --}}
                    <div class="w-20 h-20 bg-yellow-500/10 rounded-full flex items-center justify-center mx-auto mb-6 border border-yellow-500/30">
                        <i class="fas fa-search text-yellow-500 text-3xl"></i>
                    </div>
                    
                    <h3 class="text-xl font-semibold mb-4 text-white">Find Your Property</h3>
                    <p class="text-gray-300">Browse our exclusive collection of luxury properties using advanced search filters.</p>
                </div>
                
                <div class="text-center p-8 luxury-card">
                    {{-- TAMBAHKAN IKON INI --}}
                    <div class="w-20 h-20 bg-yellow-500/10 rounded-full flex items-center justify-center mx-auto mb-6 border border-yellow-500/30">
                        <i class="fas fa-calendar-check text-yellow-500 text-3xl"></i>
                    </div>

                    <h3 class="text-xl font-semibold mb-4 text-white">Schedule Viewing</h3>
                    <p class="text-gray-300">Book a private viewing with our luxury property specialists at your convenience.</p>
                </div>
                
                <div class="text-center p-8 luxury-card">
                    {{-- TAMBAHKAN IKON INI --}}
                    <div class="w-20 h-20 bg-yellow-500/10 rounded-full flex items-center justify-center mx-auto mb-6 border border-yellow-500/30">
                        <i class="fas fa-handshake text-yellow-500 text-3xl"></i>
                    </div>

                    <h3 class="text-xl font-semibold mb-4 text-white">Close The Deal</h3>
                    <p class="text-gray-300">Our experts handle all negotiations and paperwork for a smooth transaction.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter -->
    <section class="py-20 bg-gradient-to-r from-dark-gray to-black">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-4xl font-bold mb-6">Stay Updated With <span class="gold-gradient">Luxury Listings</span></h2>
                <p class="text-gray-400 mb-8">Subscribe to our newsletter for exclusive property insights and new listings.</p>
                
                <form class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Your email address" 
                           class="flex-1 bg-gray-900 border border-gray-700 rounded-lg px-6 py-4 text-white focus:outline-none focus:border-gold">
                    <button type="submit" class="bg-gold text-black font-semibold px-8 py-4 rounded-lg hover:bg-yellow-500 transition-colors">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
@endpush