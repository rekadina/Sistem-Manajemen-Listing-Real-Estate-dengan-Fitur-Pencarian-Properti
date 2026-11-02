<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-white">
                    {{ isset($category) ? 'Edit Kategori: ' . $category->< : 'Tambah Kategori Baru' }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    {{ isset($category) ? 'Perbarui informasi kategori' : 'Buat kategori properti baru' }}
                </p>
            </div>
            <a href="{{ route('admin.categories.index') }}" 
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                Kembali
            </a>
        </div>
    </x-slot>

    <form action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" 
          method="POST" class="space-y-6">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-4 rounded-lg">
                <h3 class="font-bold mb-2">Terjadi kesalahan:</h3>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informasi Kategori</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Kategori -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori *</label>
                    <input type="text" name="name" 
                           value="{{ old('name', $category->name ?? '') }}"
                           placeholder="Contoh: Penthouse, Apartmen, Mansion"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon (Emoji) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Icon (Emoji) *</label>
                    <input type="text" name="icon" 
                           value="{{ old('icon', $category->icon ?? '') }}"
                           placeholder="Contoh: 🏢 atau 🏠"
                           maxlength="10"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 text-2xl"
                           required>
                    <p class="text-xs text-gray-500 mt-1">Gunakan emoji untuk icon kategori</p>
                    @error('icon')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Urutan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampil</label>
                    <input type="number" name="order" 
                           value="{{ old('order', $category->order ?? 0) }}"
                           placeholder="0"
                           min="0"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Semakin kecil, semakin awal tampil</p>
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" 
                              rows="4"
                              placeholder="Jelaskan tipe properti ini..."
                              class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $category->description ?? '') }}</textarea>
                </div>

                <!-- Is Active -->
                <div class="md:col-span-2 flex items-center">
                    <input type="checkbox" name="is_active" value="1" id="is_active"
                           {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="is_active" class="ml-2 text-sm text-gray-700">Kategori Aktif (Tampil di Website)</label>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex gap-4 pt-4">
            <button type="submit" class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium shadow-md">
                {{ isset($category) ? 'Simpan Perubahan' : 'Tambah Kategori' }}
            </button>
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">
                Batal
            </a>
        </div>
    </form>

    <div class="mt-8 p-6 bg-blue-50 rounded-xl border border-blue-200">
        <h3 class="font-semibold text-blue-900 mb-2">💡 Tips Emoji Kategori</h3>
        <p class="text-sm text-blue-800 mb-4">Gunakan emoji yang representatif untuk setiap kategori:</p>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-sm">
            <div>🏢 Apartmen/Apartment</div>
            <div>🏰 Penthouse</div>
            <div>🏛️ Mansion</div>
            <div>🏠 Villa</div>
            <div>🏘️ Townhouse</div>
            <div>🏬 Condo</div>
            <div>🏪 Komersial</div>
            <div>🏗️ Perumahan</div>
        </div>
    </div>
</x-admin-layout>   