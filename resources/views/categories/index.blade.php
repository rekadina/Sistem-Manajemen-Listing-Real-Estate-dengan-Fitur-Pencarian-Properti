@extends('layouts.app')

@section('title', 'Property Categories - Luxury Real Estate')
@section('meta_description', 'Browse our luxury property categories: Apartments, Penthouses, Mansions, Condos, and more.')

@section('content')
<div class="bg-black min-h-screen">
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-black via-gray-900 to-black border-b border-gray-800">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                    Property <span class="gold-gradient">Categories</span>
                </h1>
                <p class="text-xl text-gray-300 mb-4">
                    Explore our exclusive collection of luxury properties organized by type
                </p>
                <p class="text-gray-400">
                    Choose a category below to view available properties that match your lifestyle
                </p>
            </div>
        </div>
    </section>

    <!-- Categories Grid -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}" 
                       class="group relative overflow-hidden rounded-2xl border border-gray-800 hover:border-yellow-500/50 transition-all duration-500">
                        
                        <!-- Background Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-900/90 via-black to-black/95 z-10 group-hover:from-gray-800/80 group-hover:via-gray-900 transition-all duration-500"></div>
                        
                        <!-- Content -->
                        <div class="relative z-20 p-12 h-80 flex flex-col justify-between">
                            <!-- Icon & Title -->
                            <div>
                                <div class="text-7xl mb-6 transform group-hover:scale-110 transition-transform duration-500">
                                    {{ $category->icon ?? '🏠' }}
                                </div>
                                <h2 class="text-4xl font-bold text-white mb-3 group-hover:text-yellow-400 transition-colors">
                                    {{ $category->name }}
                                </h2>
                                <p class="text-gray-300 text-sm leading-relaxed line-clamp-2">
                                    {{ $category->description ?? 'Discover premium ' . strtolower($category->name) . ' properties' }}
                                </p>
                            </div>

                            <!-- Stats -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-700/50">
                                <div>
                                    <div class="text-3xl font-bold text-yellow-500">
                                        {{ $category->properties_count }}
                                    </div>
                                    <div class="text-gray-400 text-sm">
                                        {{ Str::plural('Property', $category->properties_count) }}
                                    </div>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-yellow-500/20 flex items-center justify-center border border-yellow-500/30 group-hover:bg-yellow-500/30 transition-all">
                                    <svg class="w-6 h-6 text-yellow-400 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Hover Border Animation -->
                        <div class="absolute inset-0 rounded-2xl border border-yellow-500/0 group-hover:border-yellow-500/50 transition-all duration-500"></div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-16">
                        <p class="text-gray-400 text-lg mb-4">No categories available at the moment.</p>
                        <a href="{{ route('properties.index') }}" class="inline-block px-6 py-3 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-400 transition">
                            View All Properties
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Featured Properties by Category Section -->
    @if($categories->count() > 0)
    <section class="py-20 bg-gray-900/50 border-t border-gray-800">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">
                    Featured from Each <span class="text-yellow-500">Category</span>
                </h2>
                <p class="text-gray-400">Handpicked selections from our diverse portfolio</p>
            </div>

            <div class="space-y-16">
                @foreach($categories as $category)
                    @if($category->properties->count() > 0)
                    <div class="bg-black rounded-xl border border-gray-800 overflow-hidden">
                        <!-- Category Header -->
                        <div class="bg-gradient-to-r from-gray-900 to-black p-8 border-b border-gray-800 flex items-center justify-between">
                            <div>
                                <div class="flex items-center gap-4 mb-2">
                                    <span class="text-4xl">{{ $category->icon ?? '🏠' }}</span>
                                    <h3 class="text-2xl font-bold text-white">{{ $category->name }}</h3>
                                </div>
                                <p class="text-gray-400">{{ $category->properties_count }} total properties available</p>
                            </div>
                            <a href="{{ route('category.show', $category->slug) }}" class="px-6 py-3 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-400 transition">
                                View All
                            </a>
                        </div>

                        <!-- Featured Properties Grid -->
                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach($category->properties as $property)
                                    <div class="group bg-gray-900 border border-gray-800 rounded-lg overflow-hidden hover:border-yellow-500/50 transition-all duration-300">
                                        <!-- Image -->
                                        <div class="relative h-56 overflow-hidden bg-gray-800">
                                            @if($property->images && count($property->images) > 0)
                                                <img src="{{ asset('storage/' . $property->images[0]) }}" alt="{{ $property->title }}" 
                                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i class="fas fa-image text-4xl text-gray-700"></i>
                                                </div>
                                            @endif
                                            
                                            <!-- Badge -->
                                            <div class="absolute top-3 left-3 bg-yellow-500 text-black px-3 py-1 rounded-full text-xs font-bold uppercase">
                                                Featured
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="p-4">
                                            <h4 class="font-bold text-white mb-2 truncate group-hover:text-yellow-500 transition">
                                                {{ $property->title }}
                                            </h4>
                                            <p class="text-gray-400 text-sm mb-3 flex items-center gap-1">
                                                <i class="fas fa-map-marker-alt text-yellow-500"></i>
                                                {{ $property->city }}
                                            </p>
                                            <div class="flex justify-between items-end pt-3 border-t border-gray-800">
                                                <div class="text-yellow-500 font-bold">
                                                    Rp {{ number_format($property->price, 0, ',', '.') }}
                                                </div>
                                                <a href="{{ route('properties.show', $property->id) }}" class="text-gray-400 hover:text-yellow-500 transition">
                                                    <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-yellow-600 to-yellow-500">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-black mb-4">Ready to Find Your Luxury Property?</h2>
            <p class="text-black/80 mb-8">Browse all categories or use advanced search to find the perfect home</p>
            <a href="{{ route('properties.index') }}" class="inline-block px-8 py-4 bg-black text-yellow-500 font-bold rounded-lg hover:bg-gray-900 transition">
                Explore All Properties
            </a>
        </div>
    </section>
</div>
@endsection