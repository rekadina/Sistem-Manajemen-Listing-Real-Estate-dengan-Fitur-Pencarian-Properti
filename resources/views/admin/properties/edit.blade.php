<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-white">
                    Edit Properti: {{ $property->title }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Perbarui informasi properti secara lengkap
                </p>
            </div>
            <a href="{{ route('admin.properties.index') }}" 
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                Kembali
            </a>
        </div>
    </x-slot>

    <form action="{{ route('admin.properties.update', $property->id) }}" 
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informasi Dasar</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Properti *</label>
                    <input type="text" name="title" value="{{ old('title', $property->title) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                    <select name="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('category_id', $property->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Listing *</label>
                    <select name="listing_type" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="sale" {{ old('listing_type', $property->listing_type) == 'sale' ? 'selected' : '' }}>Dijual</option>
                        <option value="rent" {{ old('listing_type', $property->listing_type) == 'rent' ? 'selected' : '' }}>Disewa</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga *</label>
                    <input type="number" name="price" value="{{ old('price', $property->price) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="active" {{ old('status', $property->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="sold" {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>Terjual</option>
                        <option value="rented" {{ old('status', $property->status) == 'rented' ? 'selected' : '' }}>Disewa</option>
                        <option value="inactive" {{ old('status', $property->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                
                <div class="flex items-center mt-6">
                    <input type="checkbox" name="negotiable" value="1" id="negotiable"
                           {{ old('negotiable', $property->negotiable) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="negotiable" class="ml-2 text-sm text-gray-700">Harga bisa dinegosiasi</label>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informasi Lokasi</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi *</label>
                    <input type="text" name="province" value="{{ old('province', $property->province) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kota *</label>
                    <input type="text" name="city" value="{{ old('city', $property->city) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan *</label>
                    <input type="text" name="district" value="{{ old('district', $property->district) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                    <textarea name="address" rows="3" 
                              class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                              required>{{ old('address', $property->address) }}</textarea>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Spesifikasi Bangunan</h3>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Luas Tanah (m²)</label>
                    <input type="number" name="land_size" value="{{ old('land_size', $property->land_size) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Luas Bangunan (m²)</label>
                    <input type="number" name="building_size" value="{{ old('building_size', $property->building_size) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kamar Tidur</label>
                    <input type="number" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kamar Mandi</label>
                    <input type="number" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
                 <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lantai</label>
                    <input type="number" name="floors" value="{{ old('floors', $property->floors) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Garasi (Mobil)</label>
                    <input type="number" name="garages" value="{{ old('garages', $property->garages) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Daya Listrik (Watt)</label>
                    <input type="number" name="electricity" value="{{ old('electricity', $property->electricity) }}" 
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sertifikat</label>
                    <select name="certificate" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">-- Pilih Sertifikat --</option>
                        <option value="SHM" {{ old('certificate', $property->certificate) == 'SHM' ? 'selected' : '' }}>SHM (Sertifikat Hak Milik)</option>
                        <option value="HGB" {{ old('certificate', $property->certificate) == 'HGB' ? 'selected' : '' }}>HGB (Hak Guna Bangunan)</option>
                        <option value="Strata Title" {{ old('certificate', $property->certificate) == 'Strata Title' ? 'selected' : '' }}>Strata Title</option>
                        <option value="AJB" {{ old('certificate', $property->certificate) == 'AJB' ? 'selected' : '' }}>AJB (Akta Jual Beli)</option>
                        <option value="Lainnya" {{ old('certificate', $property->certificate) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Media & Detail</h3>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lengkap *</label>
                <textarea name="description" rows="6" 
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                          required>{{ old('description', $property->description) }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini (Centang untuk menghapus)</label>
                @if($property->images && count($property->images) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                        @foreach($property->images as $image)
                            <div class="relative group border rounded-lg overflow-hidden">
                                <img src="{{ Storage::url($image) }}" class="w-full h-32 object-cover">
                                <div class="absolute top-0 right-0 p-2 bg-white/80 rounded-bl-lg">
                                    <input type="checkbox" name="delete_images[]" value="{{ $image }}" class="w-5 h-5 text-red-600">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm italic">Belum ada gambar.</p>
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tambah Gambar Baru</label>
                <input type="file" name="images[]" multiple accept="image/*" 
                       class="w-full border border-gray-300 rounded-lg p-2">
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Fasilitas</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        @foreach($facilities as $facility)
            @php
                // Ambil data fasilitas dari old input (jika validasi gagal) atau dari database
                $currentFacilities = old('facilities', $property->facilities ?? []);
                
                // Cek apakah fasilitas ini ada kuncinya di array (karena formatnya "AC" => 1)
                $isChecked = is_array($currentFacilities) && array_key_exists($facility, $currentFacilities);
            @endphp

            <label class="flex items-center space-x-2 p-2 border rounded hover:bg-gray-50 cursor-pointer">
                <input type="checkbox" name="facilities[{{ $facility }}]" value="1" 
                       {{ $isChecked ? 'checked' : '' }}
                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">{{ $facility }}</span>
            </label>
        @endforeach
    </div>
</div>

        <div class="flex gap-4 pt-4">
            <button type="submit" class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.properties.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">
                Batal
            </a>
        </div>
    </form>
</x-admin-layout>