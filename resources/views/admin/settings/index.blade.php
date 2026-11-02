<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Pengaturan Website</h1>
                <p class="text-gray-600">Kelola pengaturan umum website properti</p>
            </div>
        </div>
    </x-slot>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="space-y-6">
            <!-- General Settings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengaturan Umum</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Site Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Website</label>
                        <input type="text" name="site_name" 
                               value="{{ old('site_name', \App\Models\Setting::getValue('site_name', 'Property Website')) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Site Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Website</label>
                        <input type="text" name="site_description" 
                               value="{{ old('site_description', \App\Models\Setting::getValue('site_description', 'Website Properti Terbaik')) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Logo Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Logo Website</label>
                        <input type="file" name="logo" accept="image/*" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @if(\App\Models\Setting::getValue('logo'))
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">Logo saat ini:</p>
                                <img src="{{ Storage::url(\App\Models\Setting::getValue('logo')) }}" 
                                     alt="Current Logo" class="h-16 mt-1">
                            </div>
                        @endif
                    </div>

                    <!-- Favicon Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Favicon</label>
                        <input type="file" name="favicon" accept="image/x-icon,image/png" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @if(\App\Models\Setting::getValue('favicon'))
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">Favicon saat ini:</p>
                                <img src="{{ Storage::url(\App\Models\Setting::getValue('favicon')) }}" 
                                     alt="Current Favicon" class="h-8 w-8 mt-1">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kontak</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Company Address -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Perusahaan</label>
                        <textarea name="company_address" rows="3" 
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('company_address', \App\Models\Setting::getValue('company_address')) }}</textarea>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                        <input type="text" name="company_phone" 
                               value="{{ old('company_phone', \App\Models\Setting::getValue('company_phone')) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="company_email" 
                               value="{{ old('company_email', \App\Models\Setting::getValue('company_email')) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- WhatsApp -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">WhatsApp</label>
                        <input type="text" name="company_whatsapp" 
                               value="{{ old('company_whatsapp', \App\Models\Setting::getValue('company_whatsapp')) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Business Hours -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jam Operasional</label>
                        <input type="text" name="business_hours" 
                               value="{{ old('business_hours', \App\Models\Setting::getValue('business_hours', 'Senin - Jumat: 09:00 - 17:00')) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Media Sosial</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Facebook -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                        <input type="url" name="social_facebook" 
                               value="{{ old('social_facebook', \App\Models\Setting::getValue('social_facebook')) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="https://facebook.com/username">
                    </div>

                    <!-- Instagram -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                        <input type="url" name="social_instagram" 
                               value="{{ old('social_instagram', \App\Models\Setting::getValue('social_instagram')) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="https://instagram.com/username">
                    </div>

                    <!-- Twitter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Twitter URL</label>
                        <input type="url" name="social_twitter" 
                               value="{{ old('social_twitter', \App\Models\Setting::getValue('social_twitter')) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="https://twitter.com/username">
                    </div>

                    <!-- LinkedIn -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                        <input type="url" name="social_linkedin" 
                               value="{{ old('social_linkedin', \App\Models\Setting::getValue('social_linkedin')) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="https://linkedin.com/company/username">
                    </div>

                    <!-- YouTube -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">YouTube URL</label>
                        <input type="url" name="social_youtube" 
                               value="{{ old('social_youtube', \App\Models\Setting::getValue('social_youtube')) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="https://youtube.com/username">
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengaturan SEO</h3>
                
                <div class="space-y-6">
                    <!-- Meta Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <input type="text" name="meta_title" 
                               value="{{ old('meta_title', \App\Models\Setting::getValue('meta_title')) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <p class="mt-1 text-sm text-gray-500">Judul yang ditampilkan di mesin pencari (50-60 karakter)</p>
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="3" 
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('meta_description', \App\Models\Setting::getValue('meta_description')) }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Deskripsi yang ditampilkan di mesin pencari (150-160 karakter)</p>
                    </div>

                    <!-- Keywords -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                        <input type="text" name="meta_keywords" 
                               value="{{ old('meta_keywords', \App\Models\Setting::getValue('meta_keywords')) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <p class="mt-1 text-sm text-gray-500">Kata kunci dipisahkan dengan koma</p>
                    </div>
                </div>
            </div>

            <!-- About Us Content -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Tentang Kami</h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konten Tentang Kami</label>
                    <textarea name="about_us_content" rows="6" 
                              class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('about_us_content', \App\Models\Setting::getValue('about_us_content')) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Deskripsi tentang perusahaan Anda</p>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium">
                    Simpan Pengaturan
                </button>
            </div>
        </div>
    </form>
</x-admin-layout>