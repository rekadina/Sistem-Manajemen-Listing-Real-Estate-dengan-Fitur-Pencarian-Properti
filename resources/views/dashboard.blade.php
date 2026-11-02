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
    {{-- FEATURED PROPERTIES SECTION --}}
    <section class="py-20 bg-black text-white">
        <div class="container mx-auto px-4">
            
            {{-- HEADER --}}
            <div class="text-center mb-12">
                <span class="font-semibold tracking-widest uppercase">Exclusive Collection Apartment</span>
                <h2 class="text-4xl font-bold mt-4 text-white">
                    Featured <span class="text-yellow-500">Luxury Properties</span>
                </h2>
                <p class="text-gray-300 mt-4 max-w-2xl mx-auto">
                    Handpicked selection of the most exclusive properties currently available
                </p>
            </div>

            {{-- GRID 3 KOLOM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                {{-- CARD 1 (Data Lama) --}}
                <div class="bg-gray-900 rounded-2xl overflow-hidden group border border-gray-800 hover:border-yellow-500/50 transition-all duration-300">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Luxury Villa" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="bg-yellow-500 text-black px-3 py-1 rounded-full text-xs font-bold uppercase">Featured</span>
                            <span class="bg-black/70 text-white px-3 py-1 rounded-full text-xs uppercase">Sale</span>
                        </div>
                        <div class="absolute bottom-4 left-4 bg-black/80 backdrop-blur-md px-4 py-2 rounded-lg">
                            <span class="text-yellow-500 font-bold text-xl">$1,894.02M</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-white">Magnam facere laboriosam</h3>
                        <p class="text-gray-400 mb-4"><i class="fas fa-map-marker-alt text-yellow-500 mr-2"></i>Baumbachburgh, Maryland</p>
                        <div class="flex justify-between text-gray-300 text-sm border-t border-gray-800 pt-4">
                            <span><i class="fas fa-bed mr-2 text-yellow-500"></i>5 Bed</span>
                            <span><i class="fas fa-bath mr-2 text-yellow-500"></i>3 Bath</span>
                            <span><i class="fas fa-ruler-combined mr-2 text-yellow-500"></i>156 m²</span>
                        </div>
                        <button class="w-full mt-6 border border-yellow-500 text-yellow-500 py-3 rounded-lg hover:bg-yellow-500 hover:text-black transition-colors font-semibold">
                            View Details
                        </button>
                    </div>
                </div>

                {{-- CARD 2 (Baru: Modern White Villa) --}}
                <div class="bg-gray-900 rounded-2xl overflow-hidden group border border-gray-800 hover:border-yellow-500/50 transition-all duration-300">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1600596542815-2a4d9f6fac90?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Modern Villa" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="bg-yellow-500 text-black px-3 py-1 rounded-full text-xs font-bold uppercase">Featured</span>
                            <span class="bg-black/70 text-white px-3 py-1 rounded-full text-xs uppercase">Rent</span>
                        </div>
                        <div class="absolute bottom-4 left-4 bg-black/80 backdrop-blur-md px-4 py-2 rounded-lg">
                            <span class="text-yellow-500 font-bold text-xl">$2,500.00M</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-white">Beverly Hills Mansion</h3>
                        <p class="text-gray-400 mb-4"><i class="fas fa-map-marker-alt text-yellow-500 mr-2"></i>Los Angeles, California</p>
                        <div class="flex justify-between text-gray-300 text-sm border-t border-gray-800 pt-4">
                            <span><i class="fas fa-bed mr-2 text-yellow-500"></i>6 Bed</span>
                            <span><i class="fas fa-bath mr-2 text-yellow-500"></i>5 Bath</span>
                            <span><i class="fas fa-ruler-combined mr-2 text-yellow-500"></i>450 m²</span>
                        </div>
                        <button class="w-full mt-6 border border-yellow-500 text-yellow-500 py-3 rounded-lg hover:bg-yellow-500 hover:text-black transition-colors font-semibold">
                            View Details
                        </button>
                    </div>
                </div>

                {{-- CARD 3 (Baru: Luxury Penthouse) --}}
                <div class="bg-gray-900 rounded-2xl overflow-hidden group border border-gray-800 hover:border-yellow-500/50 transition-all duration-300">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Penthouse" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="bg-yellow-500 text-black px-3 py-1 rounded-full text-xs font-bold uppercase">New</span>
                            <span class="bg-black/70 text-white px-3 py-1 rounded-full text-xs uppercase">Sale</span>
                        </div>
                        <div class="absolute bottom-4 left-4 bg-black/80 backdrop-blur-md px-4 py-2 rounded-lg">
                            <span class="text-yellow-500 font-bold text-xl">$4,200.00M</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-white">Skyline Penthouse</h3>
                        <p class="text-gray-400 mb-4"><i class="fas fa-map-marker-alt text-yellow-500 mr-2"></i>Manhattan, New York</p>
                        <div class="flex justify-between text-gray-300 text-sm border-t border-gray-800 pt-4">
                            <span><i class="fas fa-bed mr-2 text-yellow-500"></i>3 Bed</span>
                            <span><i class="fas fa-bath mr-2 text-yellow-500"></i>2 Bath</span>
                            <span><i class="fas fa-ruler-combined mr-2 text-yellow-500"></i>280 m²</span>
                        </div>
                        <button class="w-full mt-6 border border-yellow-500 text-yellow-500 py-3 rounded-lg hover:bg-yellow-500 hover:text-black transition-colors font-semibold">
                            View Details
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>



    <!-- Property Categories -->
    {{-- BAGIAN: KATEGORI (LATAR PUTIH) --}}
    <section class="py-20 bg-white text-gray-900">
        <div class="container mx-auto px-4">
            
            {{-- HEADER SECTION --}}
            <div class="text-center mb-16">
                <span class="font-semibold tracking-widest uppercase">Exclusive Collection Type</span>
                <h2 class="text-4xl font-bold mt-4">
                    Featured <span class="text-yellow-600">Luxury Properties</span>
                </h2>
            </div>

            {{-- GRID CONTENT (4 KOLOM) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                {{-- 1. APARTEMEN --}}
                <div class="group border border-gray-200 rounded-xl p-8 text-center hover:shadow-xl hover:border-yellow-500/50 transition-all duration-300">
                    <div class="mb-6 inline-block">
                        <span class="text-5xl">🏢</span> {{-- Icon Apartemen --}}
                    </div>
                    <h3 class="text-xl font-bold mb-3 group-hover:text-yellow-600 transition-colors">
                        Apartment
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Modern high-rise living with premium city views
                    </p>
                </div>

                {{-- 2. TOWNHOUSE --}}
                <div class="group border border-gray-200 rounded-xl p-8 text-center hover:shadow-xl hover:border-yellow-500/50 transition-all duration-300">
                    <div class="mb-6 inline-block">
                        <span class="text-5xl">🏘️</span> {{-- Icon Townhouse --}}
                    </div>
                    <h3 class="text-xl font-bold mb-3 group-hover:text-yellow-600 transition-colors">
                        TownHouse
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Exclusive urban residences with private amenities
                    </p>
                </div>

                {{-- 3. CLUSTER HOUSING --}}
                <div class="group border border-gray-200 rounded-xl p-8 text-center hover:shadow-xl hover:border-yellow-500/50 transition-all duration-300">
                    <div class="mb-6 inline-block">
                        <span class="text-5xl">🏡</span> {{-- Icon Cluster --}}
                    </div>
                    <h3 class="text-xl font-bold mb-3 group-hover:text-yellow-600 transition-colors">
                        Cluster Housing
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Secure gated communities for family living
                    </p>
                </div>

                {{-- 4. VILA / RESORT --}}
                <div class="group border border-gray-200 rounded-xl p-8 text-center hover:shadow-xl hover:border-yellow-500/50 transition-all duration-300">
                    <div class="mb-6 inline-block">
                        <span class="text-5xl">🏖️</span> {{-- Icon Vila --}}
                    </div>
                    <h3 class="text-xl font-bold mb-3 group-hover:text-yellow-600 transition-colors">
                        Vila / Resort
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Luxury holiday getaways and relaxation spots
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Stats Section -->
  <section class="py-20 bg-black">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Item 1: Total Properties --}}
            <div class="bg-white bg-opacity-5 rounded-lg p-8 text-center hover:bg-opacity-10 transition-all duration-300">
                <div class="flex justify-center mb-4">
                    <div class="bg-gray-700 rounded-full p-4">
                        <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-5xl font-bold text-white mb-2">{{ $stats['total_properties'] ?? '0' }}</div>
                <div class="text-gray-400 text-lg">Luxury Properties</div>
            </div>

            {{-- Item 2: Featured Listings --}}
            <div class="bg-white bg-opacity-5 rounded-lg p-8 text-center hover:bg-opacity-10 transition-all duration-300">
                <div class="flex justify-center mb-4">
                    <div class="bg-gray-700 rounded-full p-4">
                        <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-5xl font-bold text-white mb-2">{{ $stats['featured_properties'] ?? '0' }}</div>
                <div class="text-gray-400 text-lg">Featured Listings</div>
            </div>

            {{-- Item 3: Happy Clients --}}
            <div class="bg-white bg-opacity-5 rounded-lg p-8 text-center hover:bg-opacity-10 transition-all duration-300">
                <div class="flex justify-center mb-4">
                    <div class="bg-gray-700 rounded-full p-4">
                        <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zM7 20H2v-2a3 3 0 015.856-1.487M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-5xl font-bold text-white mb-2">{{ $stats['happy_clients'] ?? '500' }}</div>
                <div class="text-gray-400 text-lg">Happy Clients</div>
            </div>

            {{-- Item 4: Years Experience --}}
            <div class="bg-white bg-opacity-5 rounded-lg p-8 text-center hover:bg-opacity-10 transition-all duration-300">
                <div class="flex justify-center mb-4">
                    <div class="bg-gray-700 rounded-full p-4">
                        <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-5xl font-bold text-white mb-2">{{ $stats['years_experience'] ?? '15' }}</div>
                <div class="text-gray-400 text-lg">Years Experience</div>
            </div>
        </div>
    </div>
</section>
    <!-- Latest Properties -->
    {{-- LATEST PROPERTIES SECTION --}}
    <section class="py-20 bg-white text-black">
        <div class="container mx-auto px-4">
            
            {{-- HEADER (RATA TENGAH) --}}
            <div class="text-center mb-12">
                <span class="font-semibold tracking-widest uppercase text-yellow-600">New Arrivals Mansion</span>
                <h2 class="text-4xl font-bold mt-2">
                    Latest <span class="text-yellow-600">Properties</span>
                </h2>
                <a href="#" class="inline-block mt-4 text-gray-500 hover:text-yellow-600 transition-colors">
                    View All Properties <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            {{-- GRID 4 KOLOM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                {{-- CARD 1 --}}
                <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group border border-gray-100">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1600596542815-2a4d9f6fac90?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Modern Villa" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-3 right-3">
                            <span class="bg-black/70 text-white px-3 py-1 rounded text-xs uppercase font-semibold">Sale</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h4 class="font-bold text-lg mb-1 truncate">Modern White Villa</h4>
                        <p class="text-gray-500 text-sm mb-3"><i class="fas fa-map-marker-alt text-yellow-500 mr-1"></i> Beverly Hills, CA</p>
                        <div class="flex justify-between items-center border-t border-gray-100 pt-3">
                            <span class="text-yellow-600 font-bold text-lg">$2.5M</span>
                            <button class="text-gray-400 hover:text-yellow-600"><i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                {{-- CARD 2 --}}
                <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group border border-gray-100">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1613977257363-707ba9348227?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Luxury House" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-3 right-3">
                            <span class="bg-black/70 text-white px-3 py-1 rounded text-xs uppercase font-semibold">Rent</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h4 class="font-bold text-lg mb-1 truncate">The Grand Estate</h4>
                        <p class="text-gray-500 text-sm mb-3"><i class="fas fa-map-marker-alt text-yellow-500 mr-1"></i> Miami, FL</p>
                        <div class="flex justify-between items-center border-t border-gray-100 pt-3">
                            <span class="text-yellow-600 font-bold text-lg">$15K<span class="text-sm text-gray-400">/mo</span></span>
                            <button class="text-gray-400 hover:text-yellow-600"><i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                {{-- CARD 3 --}}
                <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group border border-gray-100">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Penthouse" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-3 right-3">
                            <span class="bg-black/70 text-white px-3 py-1 rounded text-xs uppercase font-semibold">Sale</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h4 class="font-bold text-lg mb-1 truncate">Skyline Penthouse</h4>
                        <p class="text-gray-500 text-sm mb-3"><i class="fas fa-map-marker-alt text-yellow-500 mr-1"></i> Manhattan, NY</p>
                        <div class="flex justify-between items-center border-t border-gray-100 pt-3">
                            <span class="text-yellow-600 font-bold text-lg">$4.2M</span>
                            <button class="text-gray-400 hover:text-yellow-600"><i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                {{-- CARD 4 --}}
                <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group border border-gray-100">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Glass House" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-3 right-3">
                            <span class="bg-black/70 text-white px-3 py-1 rounded text-xs uppercase font-semibold">Sale</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h4 class="font-bold text-lg mb-1 truncate">Minimalist Glass Home</h4>
                        <p class="text-gray-500 text-sm mb-3"><i class="fas fa-map-marker-alt text-yellow-500 mr-1"></i> Malibu, CA</p>
                        <div class="flex justify-between items-center border-t border-gray-100 pt-3">
                            <span class="text-yellow-600 font-bold text-lg">$3.8M</span>
                            <button class="text-gray-400 hover:text-yellow-600"><i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

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