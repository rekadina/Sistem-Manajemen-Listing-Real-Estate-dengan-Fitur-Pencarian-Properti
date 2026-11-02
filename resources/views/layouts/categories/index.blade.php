@extends('layouts.app')

@section('title', $category->name . ' Properties - Luxury Real Estate')
@section('meta_description', 'Browse luxury ' . strtolower($category->name) . ' for sale and rent.')

@section('content')
<div class="pt-8 pb-20">
    <div class="container mx-auto px-4">
        <!-- Category Header -->
        <div class="luxury-card p-8 rounded-2xl mb-8 text-center">
            <div class="inline-block w-24 h-24 bg-gold/10 rounded-full flex items-center justify-center mb-6">
                <span class="text-4xl">{{ $category->icon ?? '🏠' }}</span>
            </div>
            
            <h1 class="text-4xl font-bold mb-4">{{ $category->name }} <span class="gold-gradient">Properties</span></h1>
            
            <div class="max-w-2xl mx-auto">
                <p class="text-gray-400 mb-6">
                    {{ $properties->total() }} luxury {{ strtolower($category->name) }} available for sale and rent
                </p>
                
                <!-- Quick Stats -->
                <div class="grid grid-cols-3 gap-4 max-w-md mx-auto">
                    <div class="text-center p-4 bg-dark-gray/50 rounded-lg">
                        <div class="text-2xl font-bold text-gold">{{ $stats['for_sale'] ?? 0 }}</div>
                        <div class="text-gray-400 text-sm">For Sale</div>
                    </div>
                    <div class="text-center p-4 bg-dark-gray/50 rounded-lg">
                        <div class="text-2xl font-bold text-gold">{{ $stats['for_rent'] ?? 0 }}</div>
                        <div class="text-gray-400 text-sm">For Rent</div>
                    </div>
                    <div class="text-center p-4 bg-dark-gray/50 rounded-lg">
                        <div class="text-2xl font-bold text-gold">{{ $stats['featured'] ?? 0 }}</div>
                        <div class="text-gray-400 text-sm">Featured</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Properties Grid -->
        @if($properties->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($properties as $property)
            @include('properties.partials.card', ['property' => $property])
            @endforeach
        </div>

        <!-- Pagination -->
        @if($properties->hasPages())
        <div class="mt-12">
            {{ $properties->links('vendor.pagination.custom') }}
        </div>
        @endif
        @else
        <!-- No Properties -->
        <div class="luxury-card p-12 rounded-2xl text-center">
            <div class="w-24 h-24 bg-gold/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-home text-gold text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold mb-4">No Properties Found</h3>
            <p class="text-gray-400 mb-8">
                There are currently no {{ strtolower($category->name) }} properties available in this category.
            </p>
            <a href="{{ route('categories.index') }}" 
               class="inline-block bg-gold text-black px-6 py-3 rounded-lg hover:bg-yellow-500 transition-colors">
                Browse Other Categories
            </a>
        </div>
        @endif

        <!-- Category Description -->
        @if($category->description)
        <div class="luxury-card p-8 rounded-2xl mt-12">
            <h2 class="text-2xl font-bold mb-6">About {{ $category->name }}</h2>
            <div class="prose prose-invert max-w-none">
                <p class="text-gray-300 leading-relaxed">{{ $category->description }}</p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection