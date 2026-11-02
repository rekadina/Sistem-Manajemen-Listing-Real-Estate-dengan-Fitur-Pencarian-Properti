<x-admin-layout>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                {{-- JUDUL: Hitam di Light Mode, Putih di Dark Mode --}}
                <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight">
                    📬 Pesan Masuk (Inquiries)
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Kelola pertanyaan dan pesan dari calon customer.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Filter Section --}}
            {{-- BACKGROUND: Putih di Light, Abu Gelap di Dark --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 mb-6 transition-colors duration-200">
                <form method="GET" action="{{ route('admin.inquiries.index') }}" class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2 block">Filter Status</label>
                        <div class="relative">
                            {{-- SELECT INPUT: Disesuaikan agar teks terbaca di kedua mode --}}
                            <select name="status" onchange="this.form.submit()" 
                                    class="w-full appearance-none bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-white py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-600 focus:border-blue-500 transition cursor-pointer">
                                <option value="">Semua Status</option>
                                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>🟡 Baru (New)</option>
                                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>🔵 Dibaca (Read)</option>
                                <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>🟢 Dibalas (Replied)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
                    
                    @if(request('status'))
                        <div class="mb-1">
                            <a href="{{ route('admin.inquiries.index') }}" class="text-sm text-red-500 hover:text-red-700 dark:hover:text-red-400 font-medium hover:underline">
                                ✖ Reset Filter
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            {{-- Table Section --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 transition-colors duration-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                {{-- HEADER TABLE: Teks abu-abu terang di Dark Mode --}}
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Pengirim
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Pesan
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse($inquiries as $inquiry)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out group">
                                    {{-- Kolom Pengirim --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                                    {{ substr($inquiry->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                {{-- NAMA: Hitam (Light) -> Putih (Dark) --}}
                                                <div class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                                                    {{ $inquiry->name }}
                                                </div>
                                                {{-- EMAIL: Abu-abu (Light) -> Abu Terang (Dark) --}}
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $inquiry->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Kolom Subject & Pesan --}}
                                    <td class="px-6 py-4">
                                        <div class="max-w-xs">
                                            <div class="text-sm font-bold text-gray-800 dark:text-gray-200 mb-1">
                                                {{ $inquiry->subject ?? 'Tanpa Judul' }}
                                            </div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                                {{ Str::limit($inquiry->message, 50) }}
                                            </p>
                                        </div>
                                    </td>

                                    {{-- Kolom Status --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            // Warna status disesuaikan agar kontras di kedua mode
                                            $statusClasses = match($inquiry->status) {
                                                'new' => 'bg-yellow-100 text-yellow-800 border-yellow-200 dark:bg-yellow-900 dark:text-yellow-200 dark:border-yellow-700',
                                                'read' => 'bg-blue-100 text-blue-800 border-blue-200 dark:bg-blue-900 dark:text-blue-200 dark:border-blue-700',
                                                'replied' => 'bg-green-100 text-green-800 border-green-200 dark:bg-green-900 dark:text-green-200 dark:border-green-700',
                                                default => 'bg-gray-100 text-gray-800 border-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600',
                                            };
                                            
                                            $statusLabel = match($inquiry->status) {
                                                'new' => 'Baru',
                                                'read' => 'Dibaca',
                                                'replied' => 'Dibalas',
                                                default => ucfirst($inquiry->status),
                                            };
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border {{ $statusClasses }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>

                                    {{-- Kolom Tanggal --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col">
                                            <span class="font-medium">{{ $inquiry->created_at->format('d M Y') }}</span>
                                            <span class="text-xs text-gray-400 dark:text-gray-500">{{ $inquiry->created_at->format('H:i') }} WIB</span>
                                        </div>
                                    </td>

                                    {{-- Kolom Aksi --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            {{-- Tombol Lihat --}}
                                            <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" 
                                               class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm">
                                                👁️ Lihat
                                            </a>
                                            
                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-50 dark:bg-red-900/30 border border-red-100 dark:border-red-800/50 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/50 px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Belum ada pesan</h3>
                                            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Pesan dari formulir kontak akan muncul di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($inquiries->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                        {{ $inquiries->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>