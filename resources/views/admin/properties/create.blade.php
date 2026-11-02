<x-admin-layout>
    {{-- Header Standard --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Tambah Properti Baru') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Isi formulir di bawah untuk menambahkan listing properti baru
                </p>
            </div>
            <a href="{{ route('admin.properties.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- 
               LOGIKA WARNA TERBALIK:
               - Light Mode (Default): bg-gray-800 (Gelap), text-white
               - Dark Mode (Class 'dark'): bg-white (Putih), text-gray-900 
            --}}
            <div class="bg-gray-800 dark:bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100 dark:text-gray-900">
                    
                    <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        {{-- SECTION 1: INFORMASI DASAR (Sesuai Gambar) --}}
                        <div class="border-b border-gray-700 dark:border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-white dark:text-gray-900 mb-6">
                                Informasi Dasar
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- 1. Judul (Full Width) --}}
                                <div class="col-span-1 md:col-span-2">
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">Judul Properti *</label>
                                    <input type="text" name="title" value="{{ old('title') }}" 
                                           class="mt-1 block w-full rounded-md shadow-sm 
                                           bg-gray-900 border-gray-700 text-gray-300 
                                           dark:bg-white dark:border-gray-300 dark:text-gray-900
                                           focus:border-indigo-500 focus:ring-indigo-500" 
                                           placeholder="Contoh: Rumah Mewah di Pondok Indah" required>
                                </div>

                                {{-- 2. Kategori (Kiri) --}}
                                <div>
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">Kategori *</label>
                                    <select name="category_id" 
                                            class="mt-1 block w-full rounded-md shadow-sm 
                                            bg-gray-900 border-gray-700 text-gray-300 
                                            dark:bg-white dark:border-gray-300 dark:text-gray-900
                                            focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- 3. Tipe Listing (Kanan) --}}
                                <div>
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">Tipe Listing *</label>
                                    <select name="listing_type" 
                                            class="mt-1 block w-full rounded-md shadow-sm 
                                            bg-gray-900 border-gray-700 text-gray-300 
                                            dark:bg-white dark:border-gray-300 dark:text-gray-900
                                            focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="sale">Dijual</option>
                                        <option value="rent">Disewa</option>
                                    </select>
                                </div>

                                {{-- 4. Harga (Kiri) --}}
                                <div>
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">Harga (Rp) *</label>
                                    <input type="number" name="price" value="{{ old('price') }}" 
                                           class="mt-1 block w-full rounded-md shadow-sm 
                                           bg-gray-900 border-gray-700 text-gray-300 
                                           dark:bg-white dark:border-gray-300 dark:text-gray-900
                                           focus:border-indigo-500 focus:ring-indigo-500" 
                                           placeholder="Masukkan angka tanpa titik/koma" required>
                                </div>

                                {{-- 5. Status (Kanan) --}}
                                <div>
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">Status *</label>
                                    <select name="status" 
                                            class="mt-1 block w-full rounded-md shadow-sm 
                                            bg-gray-900 border-gray-700 text-gray-300 
                                            dark:bg-white dark:border-gray-300 dark:text-gray-900
                                            focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="active">Aktif</option>
                                        <option value="sold">Terjual</option>
                                        <option value="rented">Tersewa</option>
                                    </select>
                                </div>

                                {{-- 6. Checkbox Nego (Sesuai Gambar) --}}
                                <div class="col-span-1 md:col-span-2 mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="is_negotiable" value="1" 
                                               class="rounded border-gray-700 bg-gray-900 text-indigo-600 shadow-sm focus:ring-indigo-500 
                                               dark:border-gray-300 dark:bg-white">
                                        <span class="ml-2 text-sm text-gray-300 dark:text-gray-600">Harga bisa dinegosiasi</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- SECTION 2: LOKASI --}}
                        <div class="border-b border-gray-700 dark:border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-white dark:text-gray-900 mb-6">
                                Informasi Lokasi
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="col-span-3">
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">Alamat Lengkap *</label>
                                    <textarea name="address" rows="2" 
                                              class="mt-1 block w-full rounded-md shadow-sm 
                                              bg-gray-900 border-gray-700 text-gray-300 
                                              dark:bg-white dark:border-gray-300 dark:text-gray-900
                                              focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('address') }}</textarea>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">Kota</label>
                                    <input type="text" name="city" 
                                           class="mt-1 block w-full rounded-md shadow-sm 
                                           bg-gray-900 border-gray-700 text-gray-300 
                                           dark:bg-white dark:border-gray-300 dark:text-gray-900
                                           focus:border-indigo-500 focus:ring-indigo-500" required>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">Provinsi</label>
                                    <input type="text" name="province" 
                                           class="mt-1 block w-full rounded-md shadow-sm 
                                           bg-gray-900 border-gray-700 text-gray-300 
                                           dark:bg-white dark:border-gray-300 dark:text-gray-900
                                           focus:border-indigo-500 focus:ring-indigo-500" required>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">Kecamatan</label>
                                    <input type="text" name="district" 
                                           class="mt-1 block w-full rounded-md shadow-sm 
                                           bg-gray-900 border-gray-700 text-gray-300 
                                           dark:bg-white dark:border-gray-300 dark:text-gray-900
                                           focus:border-indigo-500 focus:ring-indigo-500" required>
                                </div>
                            </div>
                        </div>

                        {{-- SECTION 3: SPESIFIKASI --}}
                        <div class="border-b border-gray-700 dark:border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-white dark:text-gray-900 mb-6">
                                Spesifikasi Bangunan
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                                <div>
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">K. Tidur</label>
                                    <input type="number" name="bedrooms" 
                                           class="mt-1 block w-full rounded-md shadow-sm 
                                           bg-gray-900 border-gray-700 text-gray-300 
                                           dark:bg-white dark:border-gray-300 dark:text-gray-900
                                           focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">K. Mandi</label>
                                    <input type="number" name="bathrooms" 
                                           class="mt-1 block w-full rounded-md shadow-sm 
                                           bg-gray-900 border-gray-700 text-gray-300 
                                           dark:bg-white dark:border-gray-300 dark:text-gray-900
                                           focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">L. Tanah (m²)</label>
                                    <input type="number" name="land_size" 
                                           class="mt-1 block w-full rounded-md shadow-sm 
                                           bg-gray-900 border-gray-700 text-gray-300 
                                           dark:bg-white dark:border-gray-300 dark:text-gray-900
                                           focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">L. Bangunan (m²)</label>
                                    <input type="number" name="building_size" 
                                           class="mt-1 block w-full rounded-md shadow-sm 
                                           bg-gray-900 border-gray-700 text-gray-300 
                                           dark:bg-white dark:border-gray-300 dark:text-gray-900
                                           focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>
                        </div>

                        {{-- SECTION 4: FASILITAS --}}
                        <div class="border-b border-gray-700 dark:border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-white dark:text-gray-900 mb-6">
                                Fasilitas
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @php
                                    $facilities = ['AC', 'Kolam Renang', 'Gym', 'Parkir', 'Security 24/7', 'Taman', 'Internet', 'Dapur Modern', 'Smart Home'];
                                @endphp
                                @foreach($facilities as $facility)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="facilities[]" value="{{ $facility }}" 
                                               class="rounded border-gray-700 bg-gray-900 text-indigo-600 shadow-sm focus:ring-indigo-500 
                                               dark:border-gray-300 dark:bg-white">
                                        <label class="ml-2 text-sm text-gray-300 dark:text-gray-700">{{ $facility }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- SECTION 5: MEDIA --}}
                        <div class="pb-6">
                            <h3 class="text-lg font-medium text-white dark:text-gray-900 mb-6">
                                Foto & Deskripsi
                            </h3>
                            <div class="space-y-6">
                                <div>
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">Deskripsi Lengkap *</label>
                                    <textarea name="description" rows="5" 
                                              class="mt-1 block w-full rounded-md shadow-sm 
                                              bg-gray-900 border-gray-700 text-gray-300 
                                              dark:bg-white dark:border-gray-300 dark:text-gray-900
                                              focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description') }}</textarea>
                                </div>

                                <div>
                                    <label class="block font-medium text-sm text-gray-300 dark:text-gray-700 mb-1">Upload Foto (Bisa Banyak)</label>
                                    <input type="file" name="images[]" multiple 
                                           class="mt-1 block w-full text-sm text-gray-500 
                                           file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 
                                           file:text-sm file:font-semibold 
                                           file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 
                                           dark:file:bg-gray-900 dark:file:text-gray-300">
                                </div>
                            </div>
                        </div>

                        {{-- TOMBOL SIMPAN --}}
                        <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-700 dark:border-gray-200">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-white uppercase tracking-widest hover:bg-gray-200 dark:hover:bg-gray-700 focus:bg-gray-200 dark:focus:bg-gray-700 active:bg-gray-300 dark:active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Simpan Properti
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>