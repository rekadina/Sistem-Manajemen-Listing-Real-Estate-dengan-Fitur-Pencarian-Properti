@extends('layouts.app')

@section('title', $property->title . ' - Luxury Property')
@section('meta_description', $property->meta_description ?? 'Luxury property for ' . $property->listing_type . ' in ' . $property->city . ', ' . $property->province)

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
<style>
    /* Image Gallery */
    .gallery-image {
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    
    .gallery-image:hover {
        transform: scale(1.02);
    }
    
    /* Property Features */
    .feature-item {
        display: flex;
        align-items: center;
        padding: 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .feature-item:last-child {
        border-bottom: none;
    }
    
    /* Contact Form */
    .contact-form input,
    .contact-form textarea {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .contact-form input:focus,
    .contact-form textarea:focus {
        border-color: #D4AF37;
        background: rgba(212, 175, 55, 0.05);
    }
</style>
@endpush

@section('content')
<div class="pt-8 pb-20">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-400">
                <li><a href="{{ url('/') }}" class="hover:text-gold">Home</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li><a href="{{ route('properties.index') }}" class="hover:text-gold">Properties</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li><span class="text-gold">{{ $property->title }}</span></li>
            </ol>
        </nav>

        <!-- Property Header -->
        <div class="luxury-card p-8 rounded-2xl mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $property->title }}</h1>
                    <div class="flex items-center space-x-4">
                        <p class="text-gray-400">
                            <i class="fas fa-map-marker-alt text-gold mr-2"></i>
                            {{ $property->address }}, {{ $property->city }}, {{ $property->province }}
                        </p>
                        <span class="bg-gold/20 text-gold px-3 py-1 rounded-full text-sm">
                            {{ ucfirst($property->listing_type) }}
                        </span>
                    </div>
                </div>
                
                <div class="text-right">
                    <div class="text-4xl font-bold text-gold mb-2">
                        ${{ number_format($property->price / 1000000, 2) }}M
                    </div>
                    @if($property->negotiable)
                    <p class="text-gray-400 text-sm">Price Negotiable</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Image Gallery -->
                <div class="luxury-card rounded-2xl overflow-hidden mb-8">
                    @if($property->images && count($property->images) > 0)
                    <div class="relative">
                        <!-- Main Image -->
                        <a href="{{ Storage::url($property->images[0]) }}" data-fancybox="gallery" 
                           class="block gallery-image">
                            <img src="{{ Storage::url($property->images[0]) }}" 
                                 alt="{{ $property->title }}" 
                                 class="w-full h-96 object-cover">
                        </a>
                        
                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex space-x-2">
                            @if($property->featured)
                            <span class="bg-gold text-black px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-crown mr-1"></i> Featured
                            </span>
                            @endif
                            @if($property->status == 'sold')
                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm">
                                Sold
                            </span>
                            @elseif($property->status == 'rented')
                            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm">
                                Rented
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if(count($property->images) > 1)
                    <div class="p-6">
                        <div class="grid grid-cols-4 gap-4">
                            @foreach($property->images as $index => $image)
                            <a href="{{ Storage::url($image) }}" data-fancybox="gallery" 
                               class="gallery-image">
                                <img src="{{ Storage::url($image) }}" 
                                     alt="{{ $property->title }} - Image {{ $index + 1 }}" 
                                     class="w-full h-24 object-cover rounded-lg">
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @else
                    <div class="p-12 text-center">
                        <i class="fas fa-image text-gray-600 text-6xl mb-4"></i>
                        <p class="text-gray-400">No images available for this property</p>
                    </div>
                    @endif
                </div>

                <!-- Property Details -->
                <div class="luxury-card p-8 rounded-2xl mb-8">
                    <h2 class="text-2xl font-bold mb-6">Property Details</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Basic Info -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4 text-gold">Basic Information</h3>
                            <div class="space-y-3">
                                @if($property->category)
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Property Type</span>
                                    <span class="text-white">{{ $property->category->name }}</span>
                                </div>
                                @endif
                                
                                @if($property->land_size)
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Land Size</span>
                                    <span class="text-white">{{ $property->land_size }} m²</span>
                                </div>
                                @endif
                                
                                @if($property->building_size)
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Building Size</span>
                                    <span class="text-white">{{ $property->building_size }} m²</span>
                                </div>
                                @endif
                                
                                @if($property->bedrooms)
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Bedrooms</span>
                                    <span class="text-white">{{ $property->bedrooms }}</span>
                                </div>
                                @endif
                                
                                @if($property->bathrooms)
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Bathrooms</span>
                                    <span class="text-white">{{ $property->bathrooms }}</span>
                                </div>
                                @endif
                                
                                @if($property->floors)
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Floors</span>
                                    <span class="text-white">{{ $property->floors }}</span>
                                </div>
                                @endif
                                
                                @if($property->garages)
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Garage</span>
                                    <span class="text-white">{{ $property->garages }} cars</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Additional Info -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4 text-gold">Additional Information</h3>
                            <div class="space-y-3">
                                @if($property->certificate)
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Certificate</span>
                                    <span class="text-white">{{ strtoupper($property->certificate) }}</span>
                                </div>
                                @endif
                                
                                @if($property->electricity)
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Electricity</span>
                                    <span class="text-white">{{ $property->electricity }} Watt</span>
                                </div>
                                @endif
                                
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Property Status</span>
                                    <span class="text-white capitalize">{{ $property->status }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Posted</span>
                                    <span class="text-white">{{ $property->created_at->format('d F Y') }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Views</span>
                                    <span class="text-white">{{ number_format($property->views) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="luxury-card p-8 rounded-2xl mb-8">
                    <h2 class="text-2xl font-bold mb-6">Description</h2>
                    <div class="prose prose-invert max-w-none">
                        <p class="text-gray-300 leading-relaxed">{{ $property->description }}</p>
                    </div>
                </div>

                <!-- Facilities -->
                @if($property->facilities && count($property->facilities) > 0)
                <div class="luxury-card p-8 rounded-2xl mb-8">
                    <h2 class="text-2xl font-bold mb-6">Facilities & Amenities</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($property->facilities as $facility)
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gold/10 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-gold"></i>
                            </div>
                            <span class="text-white">{{ $facility }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Video Tour -->
                @if($property->video_url)
                <div class="luxury-card p-8 rounded-2xl mb-8">
                    <h2 class="text-2xl font-bold mb-6">Video Tour</h2>
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe src="{{ $property->video_url }}" 
                                class="w-full h-96 rounded-lg" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Inquiry Form -->
                <div class="luxury-card p-6 rounded-2xl mb-8 sticky top-24">
                    <h3 class="text-xl font-semibold mb-6">Schedule a Viewing</h3>
                    
                    <form action="{{ route('inquiries.store') }}" method="POST" class="contact-form space-y-4">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        
                        <div>
                            <input type="text" name="name" placeholder="Your Name" required
                                   class="w-full rounded-lg px-4 py-3 text-white">
                        </div>
                        
                        <div>
                            <input type="email" name="email" placeholder="Email Address" required
                                   class="w-full rounded-lg px-4 py-3 text-white">
                        </div>
                        
                        <div>
                            <input type="tel" name="phone" placeholder="Phone Number" required
                                   class="w-full rounded-lg px-4 py-3 text-white">
                        </div>
                        
                        <div>
                            <textarea name="message" rows="4" placeholder="Your Message" required
                                      class="w-full rounded-lg px-4 py-3 text-white"></textarea>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-gold text-black font-semibold py-3 rounded-lg hover:bg-yellow-500 transition-colors">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Schedule Viewing
                        </button>
                    </form>
                </div>

                <!-- Agent Info -->
                @if($property->agent)
                <div class="luxury-card p-6 rounded-2xl mb-8">
                    <h3 class="text-xl font-semibold mb-6">Contact Agent</h3>
                    
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-16 h-16 bg-gold/10 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-gold text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">{{ $property->agent->name }}</h4>
                            <p class="text-gray-400 text-sm">Luxury Property Specialist</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <a href="tel:{{ $property->agent->phone ?? '+1234567890' }}" 
                           class="flex items-center text-gray-300 hover:text-gold transition-colors">
                            <i class="fas fa-phone text-gold mr-3"></i>
                            <span>{{ $property->agent->phone ?? '+1 (234) 567-890' }}</span>
                        </a>
                        
                        <a href="mailto:{{ $property->agent->email }}" 
                           class="flex items-center text-gray-300 hover:text-gold transition-colors">
                            <i class="fas fa-envelope text-gold mr-3"></i>
                            <span>{{ $property->agent->email }}</span>
                        </a>
                    </div>
                    
                    <button class="w-full border border-gold text-gold py-3 rounded-lg mt-6 hover:bg-gold hover:text-black transition-colors">
                        <i class="fas fa-comment-alt mr-2"></i>
                        WhatsApp Chat
                    </button>
                </div>
                @endif

                <!-- Share Property -->
                <div class="luxury-card p-6 rounded-2xl mb-8">
                    <h3 class="text-xl font-semibold mb-6">Share This Property</h3>
                    
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" 
                           target="_blank" 
                           class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $property->title }}" 
                           target="_blank" 
                           class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $property->title }}" 
                           target="_blank" 
                           class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center hover:bg-blue-800 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        
                        <a href="https://wa.me/?text={{ urlencode('Check out this luxury property: ' . $property->title . ' ' . url()->current()) }}" 
                           target="_blank" 
                           class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Location Map -->
                @if($property->latitude && $property->longitude)
                <div class="luxury-card p-6 rounded-2xl">
                    <h3 class="text-xl font-semibold mb-6">Location</h3>
                    <div class="aspect-w-1 aspect-h-1">
                        <div id="property-map" class="rounded-lg bg-gray-800"></div>
                    </div>
                    <p class="text-gray-400 text-sm mt-4">
                        <i class="fas fa-map-marker-alt text-gold mr-2"></i>
                        {{ $property->address }}
                    </p>
                </div>
                @endif
            </div>
        </div>

        <!-- Similar Properties -->
        @if($similarProperties->count() > 0)
        <div class="mt-20">
            <h2 class="text-3xl font-bold mb-8">Similar <span class="gold-gradient">Properties</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($similarProperties as $similar)
                @include('properties.partials.card', ['property' => $similar])
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    // Initialize Fancybox
    Fancybox.bind("[data-fancybox]", {
        // Your custom options
    });
    
    // Initialize Google Maps
    @if($property->latitude && $property->longitude)
    function initMap() {
        const location = { lat: {{ $property->latitude }}, lng: {{ $property->longitude }} };
        const map = new google.maps.Map(document.getElementById("property-map"), {
            zoom: 15,
            center: location,
            styles: [
                { elementType: "geometry", stylers: [{ color: "#242f3e" }] },
                { elementType: "labels.text.stroke", stylers: [{ color: "#242f3e" }] },
                { elementType: "labels.text.fill", stylers: [{ color: "#746855" }] },
                {
                    featureType: "administrative.locality",
                    elementType: "labels.text.fill",
                    stylers: [{ color: "#d4af37" }]
                },
                {
                    featureType: "poi",
                    elementType: "labels.text.fill",
                    stylers: [{ color: "#d4af37" }]
                },
                {
                    featureType: "road",
                    elementType: "geometry",
                    stylers: [{ color: "#38414e" }]
                },
                {
                    featureType: "road",
                    elementType: "geometry.stroke",
                    stylers: [{ color: "#212a37" }]
                },
                {
                    featureType: "road",
                    elementType: "labels.text.fill",
                    stylers: [{ color: "#9ca5b3" }]
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry",
                    stylers: [{ color: "#746855" }]
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry.stroke",
                    stylers: [{ color: "#1f2835" }]
                },
                {
                    featureType: "road.highway",
                    elementType: "labels.text.fill",
                    stylers: [{ color: "#f3d19c" }]
                },
                {
                    featureType: "water",
                    elementType: "geometry",
                    stylers: [{ color: "#17263c" }]
                },
                {
                    featureType: "water",
                    elementType: "labels.text.fill",
                    stylers: [{ color: "#515c6d" }]
                },
                {
                    featureType: "water",
                    elementType: "labels.text.stroke",
                    stylers: [{ color: "#17263c" }]
                }
            ]
        });
        
        new google.maps.Marker({
            position: location,
            map: map,
            icon: {
                url: "https://maps.google.com/mapfiles/ms/icons/gold-dot.png"
            }
        });
    }
    @endif
</script>
@if($property->latitude && $property->longitude)
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
@endif
@endpush