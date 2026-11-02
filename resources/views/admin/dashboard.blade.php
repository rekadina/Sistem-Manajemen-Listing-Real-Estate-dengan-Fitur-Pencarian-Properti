<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-3xl text-gray-900 dark:text-white leading-tight">
                    🏠 Dashboard Properti
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                    Selamat datang kembali! Kelola properti Anda dengan mudah
                </p>
            </div>
            <a href="{{ route('admin.properties.create') }}" 
               class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-3 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2 font-medium">
                <span class="text-xl">+</span>
                <span>Properti Baru</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Statistik Cards - Grid 4 Kolom -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Properties -->
                <div class="group bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium opacity-90">Total Properti</p>
                            <p class="text-4xl font-bold text-white mt-3">
                                {{ $stats['totalProperties'] }}
                            </p>
                            <p class="text-blue-100 text-xs mt-2 opacity-75">
                                Semua listing properti
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-3xl group-hover:rotate-12 transition-transform">
                            🏢
                        </div>
                    </div>
                </div>

                <!-- Active Properties -->
                <div class="group bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium opacity-90">Properti Aktif</p>
                            <p class="text-4xl font-bold text-white mt-3">
                                {{ $stats['activeProperties'] }}
                            </p>
                            <p class="text-green-100 text-xs mt-2 opacity-75">
                                @php
                                    $percentage = $stats['totalProperties'] > 0 ? 
                                        ($stats['activeProperties'] / $stats['totalProperties']) * 100 : 0;
                                @endphp
                                {{ number_format($percentage, 0) }}% dari total
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-3xl group-hover:rotate-12 transition-transform">
                            ✅
                        </div>
                    </div>
                </div>

                <!-- Featured Properties -->
                <div class="group bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-100 text-sm font-medium opacity-90">Unggulan</p>
                            <p class="text-4xl font-bold text-white mt-3">
                                {{ $stats['featuredProperties'] }}
                            </p>
                            <p class="text-yellow-100 text-xs mt-2 opacity-75">
                                Properti pilihan
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-3xl group-hover:rotate-12 transition-transform">
                            ⭐
                        </div>
                    </div>
                </div>

                <!-- My Properties -->
                <div class="group bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium opacity-90">Milik Saya</p>
                            <p class="text-4xl font-bold text-white mt-3">
                                {{ $stats['myProperties'] }}
                            </p>
                            <p class="text-purple-100 text-xs mt-2 opacity-75">
                                Properti Anda
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-3xl group-hover:rotate-12 transition-transform">
                            👤
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions - 3 Kolom -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <a href="{{ route('admin.properties.index') }}" 
                   class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 border-l-4 border-blue-500">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                            📋
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 dark:text-white">Kelola Properti</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Lihat & edit semua</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.inquiries.index') }}" 
                   class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 border-l-4 border-green-500">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-green-100 dark:bg-green-900 rounded-xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                            📧
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 dark:text-white">Kelola Inquiry</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Lihat pesan masuk</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.properties.create') }}" 
                   class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 border-l-4 border-purple-500">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900 rounded-xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                            🎯
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 dark:text-white">Properti Baru</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Tambah listing</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Recent Properties Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700 mb-8">
                <div class="p-8 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                🏆 Properti Terbaru
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">6 properti terbaru Anda</p>
                        </div>
                        <a href="{{ route('admin.properties.index') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-300">
                            Lihat Semua →
                        </a>
                    </div>
                </div>

                <div class="p-8">
                    @if($recentProperties->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($recentProperties as $property)
                                <div class="group bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 rounded-xl p-5 hover:shadow-lg transition-all duration-300 border border-gray-200 dark:border-gray-500 overflow-hidden">
                                    <!-- Header dengan Badge -->
                                    <div class="flex justify-between items-start mb-4">
                                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                            @if($property->listing_type === 'sale') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                            @elseif($property->listing_type === 'rent') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                            @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 @endif">
                                            {{ $property->listing_type ? ucfirst($property->listing_type) : 'N/A' }}
                                        </span>
                                        
                                        @if($property->featured)
                                            <span class="inline-flex items-center space-x-1 px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded-full">
                                                <span>⭐</span>
                                                <span>Unggulan</span>
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Judul -->
                                    <h4 class="font-bold text-lg text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                        {{ $property->title ?? 'No Title' }}
                                    </h4>

                                    <!-- Deskripsi -->
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
                                        {{ Str::limit($property->description ?? 'No description', 80) }}
                                    </p>

                                    <!-- Harga -->
                                    <div class="mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg">
                                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                            Rp {{ number_format($property->price ?? 0, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <!-- Info Properties -->
                                    <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                                        @if($property->bedrooms)
                                            <div class="bg-white dark:bg-gray-800 rounded-lg p-2">
                                                <p class="text-xl">🛏️</p>
                                                <p class="text-xs font-semibold text-gray-700 dark:text-gray-300">{{ $property->bedrooms }}</p>
                                                <p class="text-xs text-gray-500">Kamar</p>
                                            </div>
                                        @endif
                                        @if($property->bathrooms)
                                            <div class="bg-white dark:bg-gray-800 rounded-lg p-2">
                                                <p class="text-xl">🚿</p>
                                                <p class="text-xs font-semibold text-gray-700 dark:text-gray-300">{{ $property->bathrooms }}</p>
                                                <p class="text-xs text-gray-500">Kamar Mandi</p>
                                            </div>
                                        @endif
                                        @if($property->building_size)
                                            <div class="bg-white dark:bg-gray-800 rounded-lg p-2">
                                                <p class="text-xl">📐</p>
                                                <p class="text-xs font-semibold text-gray-700 dark:text-gray-300">{{ $property->building_size }}</p>
                                                <p class="text-xs text-gray-500">m²</p>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Status Badge -->
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-500">
                                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                            @if($property->status === 'active') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                            @elseif($property->status === 'sold') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                            @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 @endif">
                                            {{ $property->status ? ucfirst($property->status) : 'Unknown' }}
                                        </span>
                                        <a href="{{ route('admin.properties.edit', $property->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                            Edit →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div class="w-24 h-24 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6 text-5xl">
                                🏠
                            </div>
                            <h4 class="text-2xl font-bold text-gray-800 dark:text-white mb-3">
                                Belum ada properti
                            </h4>
                            <p class="text-gray-500 dark:text-gray-400 mb-6 text-lg">
                                Mulai dengan menambahkan properti pertama Anda untuk memulai bisnis properti
                            </p>
                            <a href="{{ route('admin.properties.create') }}" 
                               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors duration-300">
                                + Tambah Properti Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            

            <!-- Recent Inquiries Section -->
            @if($recentInquiries->count() > 0)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="p-8 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                📧 Inquiry Terbaru
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">5 inquiry terbaru</p>
                        </div>
                        <a href="{{ route('admin.inquiries.index') }}" 
                           class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-300">
                            Lihat Semua →
                        </a>
                    </div>
                </div>

                <div class="p-8">
                    <div class="space-y-4">
                        @foreach($recentInquiries as $inquiry)
                        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                    <span class="text-lg">👤</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">{{ $inquiry->name ?? 'Unknown' }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $inquiry->email ?? 'No email' }}</p>
                                    <p class="text-xs text-gray-400">{{ $inquiry->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                    {{ $inquiry->status ?? 'new' }}
                                </span>
                                <p class="text-sm text-gray-500 mt-1">{{ Str::limit($inquiry->message ?? 'No message', 50) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>