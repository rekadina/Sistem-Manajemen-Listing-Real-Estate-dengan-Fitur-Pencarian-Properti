<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-white">
                    {{ $property->title }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    ID: {{ $property->id }} • {{ ucfirst($property->status) }}
                </p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.properties.edit', $property) }}" 
                   class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">
                    Edit
                </a>
                <form action="{{ route('admin.properties.destroy', $property) }}" 
                      method="POST" 
                      onsubmit="return confirm('Hapus properti ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Hapus
                    </button>
                </form>
                <a href="{{ route('admin.properties.index') }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Gallery -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                @if($property->images && count($property->images) > 0)
                    <div class="relative h-96 bg-gray-200">
                        <img id="mainImage" src="{{ Storage::url($property->images[0]) }}" 
                             alt="{{ $property->title }}" class="w-full h-full object-cover">
                        
                        @if(count($property->images) > 1)
                            <button onclick="prevImage()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 text-white p-3 rounded-full hover:bg-black/75">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 text-white p-3 rounded-full hover:bg-black/75">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        @endif
                    </div>

                    <!-- Thumbnails -->
                    @if(count($property->images) > 1)
                        <div class="bg-gray-50 p-4 overflow-x-auto">
                            <div class="flex gap-2">
                                @foreach($property->images as $index => $image)
                                    <button onclick="changeImage({{ $index }})" class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 border-gray-300 hover:border-blue-500 transition">
                                        <img src="{{ Storage::url($image) }}" alt="Thumbnail" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <div class="h-96 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Tidak ada gambar</span>
                    </div>
                @endif
            </div>

            <!-- Info Section -->
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <p class="text-gray-600 text-sm font-semibold mb-1">KATEGORI</p>
                    <p class="text-lg font-bold">{{ $property->category->name ?? '-' }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <p class="text-gray-600 text-sm font-semibold mb-1">TIPE</p>
                    <p class="text-lg font-bold capitalize">{{ $property->listing_type }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <p class="text-gray-600 text-sm font-semibold mb-1">STATUS</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        {{ ucfirst($property->status) }}
                    </span>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <p class="text-gray-600 text-sm font-semibold mb-1">FEATURED</p>
                    <p class="text-lg font-bold">{{ $property->featured ? '✓ Ya' : 'Tidak' }}</p>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Deskripsi</h3>
                <p class="text-gray-600 whitespace-pre-line">{{ $property->description }}</p>
            </div>

            <!-- Spesifikasi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Spesifikasi</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Kamar Tidur</p>
                        <p class="text-2xl font-bold">{{ $property->bedrooms ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Kamar Mandi</p>
                        <p class="text-2xl font-bold">{{ $property->bathrooms ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Luas Tanah</p>
                        <p class="text-2xl font-bold">{{ $property->land_size ?? '-' }} m²</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Luas Bangunan</p>
                        <p class="text-2xl font-bold">{{ $property->building_size ?? '-' }} m²</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Lantai</p>
                        <p class="text-2xl font-bold">{{ $property->floors ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Garasi</p>
                        <p class="text-2xl font-bold">{{ $property->garages ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Listrik</p>
                        <p class="text-2xl font-bold">{{ $property->electricity ?? '-' }} W</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Sertifikat</p>
                        <p class="text-2xl font-bold">{{ $property->certificate ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Fasilitas -->
            @if($property->facilities && count($property->facilities) > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Fasilitas</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($property->facilities as $facility)
                            <div class="flex items-center gap-2 text-gray-700">
                                <i class="fas fa-check-circle text-green-600"></i>
                                {{ $facility }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Harga -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-gray-600 text-sm font-semibold mb-2">HARGA</p>
                <p class="text-3xl font-bold text-yellow-600">
                    Rp {{ number_format($property->price, 0, ',', '.') }}
                </p>
                @if($property->negotiable)
                    <p class="text-sm text-green-600 mt-2">✓ Dapat dinegosiasikan</p>
                @endif
            </div>

            <!-- Lokasi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-gray-600 text-sm font-semibold mb-4">LOKASI</p>
                <div class="space-y-2 text-gray-700">
                    <div>
                        <p class="text-sm text-gray-600">Alamat</p>
                        <p class="font-semibold">{{ $property->address }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Kota</p>
                        <p class="font-semibold">{{ $property->city }}, {{ $property->province }}</p>
                    </div>
                    @if($property->district)
                        <div>
                            <p class="text-sm text-gray-600">Kecamatan</p>
                            <p class="font-semibold">{{ $property->district }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-gray-600 text-sm font-semibold mb-4">INFORMASI</p>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600">Dibuat</p>
                        <p class="font-semibold">{{ $property->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Diupdate</p>
                        <p class="font-semibold">{{ $property->updated_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Penulis</p>
                        <p class="font-semibold">{{ $property->user->name ?? 'Admin' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let currentImageIndex = 0;
        const images = {!! json_encode($property->images ?? []) !!};

        function changeImage(index) {
            currentImageIndex = index;
            updateImage();
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            updateImage();
        }

        function prevImage() {
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            updateImage();
        }

        function updateImage() {
            const mainImage = document.getElementById('mainImage');
            if (mainImage && images[currentImageIndex]) {
                mainImage.src = '{{ Storage::url('') }}' + images[currentImageIndex];
            }
        }
    </script>
    @endpush
</x-admin-layout>