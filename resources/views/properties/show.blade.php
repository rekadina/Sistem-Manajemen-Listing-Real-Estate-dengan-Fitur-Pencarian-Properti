@extends('layouts.app')

@section('content')
<div class="bg-black min-h-screen">
    <div class="bg-black border-b border-gray-700 py-4">
        <div class="container mx-auto px-4">
            <a href="{{ route('properties.index') }}" class="text-yellow-500 hover:text-yellow-400 font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Properties
            </a>
        </div>
    </div>

    <div class="bg-black py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="mb-6 rounded-lg overflow-hidden relative group border border-gray-800">
                        @if($property->images && count($property->images) > 0)
                            <img id="mainImage"
                                 src="{{ asset('storage/' . $property->images[0]) }}" 
                                 alt="{{ $property->title }}" 
                                 class="w-full h-[500px] object-cover transition-all duration-1000 ease-in-out opacity-100"
                                 style="animation: fadeInImage 1s ease-in-out;">
                            
                            <div class="absolute top-4 right-4 bg-black/70 text-white px-3 py-1 rounded-full text-sm backdrop-blur-sm border border-white/10">
                                <span id="imageCounter">1</span> / <span>{{ count($property->images) }}</span>
                            </div>

                            @if(count($property->images) > 1)
                                <button onclick="previousImage()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-yellow-500 text-black p-3 rounded-full hover:bg-yellow-400 z-10 opacity-0 group-hover:opacity-100 transition-all shadow-lg">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-yellow-500 text-black p-3 rounded-full hover:bg-yellow-400 z-10 opacity-0 group-hover:opacity-100 transition-all shadow-lg">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            @endif
                        @else
                            <div class="w-full h-[500px] bg-gray-900 flex items-center justify-center rounded-lg border border-gray-800">
                                <span class="text-gray-500">No Image Available</span>
                            </div>
                        @endif
                    </div>

                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-8 mb-6 shadow-2xl">
                        <div class="border-b border-gray-700 pb-6 mb-6">
                            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">{{ $property->title }}</h1>
                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                <span class="bg-yellow-500/10 text-yellow-500 px-3 py-1 rounded-full border border-yellow-500/20 font-semibold">
                                    {{ $property->category->name ?? 'Property' }}
                                </span>
                                <span class="text-gray-400 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2"></i> 
                                    {{ $property->address }}, {{ $property->city }}
                                </span>
                            </div>
                        </div>

                        <h3 class="text-white font-bold text-lg mb-4 flex items-center">
                            <i class="fas fa-info-circle text-yellow-500 mr-2"></i> Property Details
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                            <div class="bg-black/40 border border-gray-700 rounded-lg p-4 text-center hover:border-yellow-500/50 transition-colors">
                                <i class="fas fa-bed text-gray-500 mb-2 text-xl"></i>
                                <div class="text-xl font-bold text-white">{{ $property->bedrooms ?? '-' }}</div>
                                <div class="text-gray-500 text-xs uppercase tracking-wider">Bedrooms</div>
                            </div>
                            <div class="bg-black/40 border border-gray-700 rounded-lg p-4 text-center hover:border-yellow-500/50 transition-colors">
                                <i class="fas fa-bath text-gray-500 mb-2 text-xl"></i>
                                <div class="text-xl font-bold text-white">{{ $property->bathrooms ?? '-' }}</div>
                                <div class="text-gray-500 text-xs uppercase tracking-wider">Bathrooms</div>
                            </div>
                            <div class="bg-black/40 border border-gray-700 rounded-lg p-4 text-center hover:border-yellow-500/50 transition-colors">
                                <i class="fas fa-ruler-combined text-gray-500 mb-2 text-xl"></i>
                                <div class="text-xl font-bold text-white">{{ $property->land_size ?? '-' }}</div>
                                <div class="text-gray-500 text-xs uppercase tracking-wider">Land (m²)</div>
                            </div>
                             <div class="bg-black/40 border border-gray-700 rounded-lg p-4 text-center hover:border-yellow-500/50 transition-colors">
                                <i class="fas fa-home text-gray-500 mb-2 text-xl"></i>
                                <div class="text-xl font-bold text-white">{{ $property->building_size ?? '-' }}</div>
                                <div class="text-gray-500 text-xs uppercase tracking-wider">Build (m²)</div>
                            </div>
                            <div class="bg-black/40 border border-gray-700 rounded-lg p-4 text-center hover:border-yellow-500/50 transition-colors">
                                <i class="fas fa-layer-group text-gray-500 mb-2 text-xl"></i>
                                <div class="text-xl font-bold text-white">{{ $property->floors ?? '-' }}</div>
                                <div class="text-gray-500 text-xs uppercase tracking-wider">Floors</div>
                            </div>
                            <div class="bg-black/40 border border-gray-700 rounded-lg p-4 text-center hover:border-yellow-500/50 transition-colors">
                                <i class="fas fa-car text-gray-500 mb-2 text-xl"></i>
                                <div class="text-xl font-bold text-white">{{ $property->garages ?? '-' }}</div>
                                <div class="text-gray-500 text-xs uppercase tracking-wider">Garages</div>
                            </div>
                             <div class="bg-black/40 border border-gray-700 rounded-lg p-4 text-center hover:border-yellow-500/50 transition-colors">
                                <i class="fas fa-bolt text-gray-500 mb-2 text-xl"></i>
                                <div class="text-xl font-bold text-white">{{ $property->electricity ?? '-' }}</div>
                                <div class="text-gray-500 text-xs uppercase tracking-wider">Watt</div>
                            </div>
                             <div class="bg-black/40 border border-gray-700 rounded-lg p-4 text-center hover:border-yellow-500/50 transition-colors">
                                <i class="fas fa-file-contract text-gray-500 mb-2 text-xl"></i>
                                <div class="text-lg font-bold text-white uppercase">{{ $property->certificate ?? '-' }}</div>
                                <div class="text-gray-500 text-xs uppercase tracking-wider">Cert</div>
                            </div>
                        </div>

                        {{-- Cek apakah fasilitas ada isinya --}}
@if(!empty($property->facilities) && is_array($property->facilities))
    <div class="mb-8 border-t border-gray-700 pt-6">
        <h3 class="heading-3">Facilities</h3>
        
        <div class="row">
            {{-- Loop data fasilitas --}}
            @foreach($property->facilities as $facility)
                <div class="col-md-4 mb-3">
                    <div class="d-flex align-items-center">
                        {{-- Icon Checklist --}}
                        <span class="icon-check text-success me-2">✓</span>
                        
                        {{-- Tampilkan Text Fasilitas (Bukan Angka/Key) --}}
                        <span class="text-white">{{ $facility }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif  {{-- <--- JANGAN LUPA INI! --}}

                        <div class="border-t border-gray-700 pt-6">
                            <h3 class="text-xl font-bold text-white mb-3">Description</h3>
                            <p class="text-gray-400 leading-relaxed whitespace-pre-line text-lg">{{ $property->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-8 bg-gray-900 border border-gray-700 rounded-xl p-8 shadow-2xl">
                        <div class="mb-6 pb-6 border-b border-gray-700">
                            <div class="text-gray-400 text-sm mb-2 uppercase tracking-wider">Offered at</div>
                            <div class="text-4xl font-bold text-yellow-500">
                                Rp {{ number_format($property->price, 0, ',', '.') }}
                                @if($property->listing_type == 'rent') <span class="text-lg text-gray-400 font-normal">/ year</span> @endif
                            </div>
                            @if($property->negotiable)
                                <span class="inline-block mt-2 bg-green-900/30 text-green-400 text-xs px-2 py-1 rounded border border-green-900">Negotiable</span>
                            @endif
                        </div>

                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center font-bold text-black text-xl">
                                {{ substr($property->user->name ?? 'A', 0, 1) }}
                            </div>
                            <div>
                                <div class="text-gray-400 text-xs">Listed by</div>
                                <div class="text-white font-bold">{{ $property->user->name ?? 'Admin Agency' }}</div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20properti:%20{{ urlencode($property->title) }}" 
                               target="_blank"
                               class="w-full px-4 py-4 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-400 transition flex items-center justify-center gap-2 transform hover:scale-[1.02] duration-200">
                                <i class="fab fa-whatsapp text-lg"></i>
                                WhatsApp Agent
                            </a>
                            <button class="w-full px-4 py-4 bg-gray-800 text-white font-bold rounded-lg hover:bg-gray-700 transition border border-gray-700 flex items-center justify-center gap-2">
                                <i class="fas fa-phone-alt"></i>
                                Call Agent
                            </button>
                        </div>

                        <div class="pt-6 mt-6 border-t border-gray-700">
                            <p class="text-gray-500 text-sm mb-3 text-center">Share this property</p>
                            <div class="flex justify-center gap-4">
                                <button class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook fa-lg"></i></button>
                                <button class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter fa-lg"></i></button>
                                <button class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram fa-lg"></i></button>
                                <button class="text-gray-400 hover:text-white transition"><i class="fas fa-link fa-lg"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($relatedProperties) && $relatedProperties->count() > 0)
                <div class="mt-16 pt-12 border-t border-gray-800">
                    <h2 class="text-3xl font-bold text-white mb-8">Related Properties</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($relatedProperties as $related)
                            <div class="group bg-gray-900 border border-gray-700 rounded-lg overflow-hidden hover:border-yellow-500 transition duration-300">
                                <div class="relative h-56 overflow-hidden bg-gray-800">
                                    @if($related->images && count($related->images) > 0)
                                        <img src="{{ asset('storage/' . $related->images[0]) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-image text-4xl text-gray-700"></i>
                                        </div>
                                    @endif
                                    <div class="absolute top-3 left-3 bg-black/60 backdrop-blur-md text-white px-3 py-1 rounded text-xs">
                                        {{ $related->category->name ?? 'Property' }}
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-white mb-2 truncate group-hover:text-yellow-500 transition">{{ $related->title }}</h3>
                                    <div class="flex justify-between items-end">
                                        <div>
                                            <div class="text-xs text-gray-500 mb-1">{{ $related->city }}</div>
                                            <div class="text-yellow-500 font-bold text-xl">Rp {{ number_format($related->price, 0, ',', '.') }}</div>
                                        </div>
                                        <a href="{{ route('properties.show', $related->id) }}" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-white hover:bg-yellow-500 hover:text-black transition">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
@keyframes fadeInImage { from { opacity: 0; } to { opacity: 1; } }
@keyframes slideInImage { from { opacity: 0; transform: scale(0.98); } to { opacity: 1; transform: scale(1); } }
#mainImage { animation: slideInImage 0.5s ease-in-out !important; }
</style>

<script>
let currentImageIndex = 0;
const totalImages = {{ !empty($property->images) ? count($property->images) : 0 }};
const images = {!! !empty($property->images) ? json_encode($property->images) : '[]' !!};

function showImage(index) {
    if (totalImages === 0) return;
    if (index < 0) currentImageIndex = totalImages - 1;
    else if (index >= totalImages) currentImageIndex = 0;
    else currentImageIndex = index;
    
    const mainImg = document.getElementById('mainImage');
    const counter = document.getElementById('imageCounter');
    
    if (mainImg) {
        mainImg.style.opacity = '0';
        setTimeout(() => {
            mainImg.src = '{{ asset('storage/') }}' + '/' + images[currentImageIndex];
            mainImg.style.opacity = '1';
        }, 200);
    }
    if (counter) counter.textContent = currentImageIndex + 1;
}

function nextImage() { showImage(currentImageIndex + 1); }
function previousImage() { showImage(currentImageIndex - 1); }

// Auto-slide stops on hover (optional)
let slideInterval = setInterval(nextImage, 5000);
</script>
@endsection