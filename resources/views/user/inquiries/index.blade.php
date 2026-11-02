@extends('layouts.app')

@section('title', 'My Inquiries - LuxuryEstate')

@section('content')
<div class="bg-black min-h-screen py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8 px-4">
            <div>
                <h2 class="text-3xl font-bold text-white">
                    My <span class="text-yellow-500">Inquiries</span>
                </h2>
                <p class="text-gray-400 mt-2">Riwayat pesan dan balasan dari admin.</p>
            </div>
            <a href="{{ route('contact') }}" class="bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-2 px-4 rounded-lg transition shadow-lg">
                + Buat Pesan Baru
            </a>
        </div>

        {{-- Table Container --}}
        <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-800 mx-4">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-800">
                    <thead class="bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-yellow-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-yellow-500 uppercase tracking-wider">
                                Subject & Pesan
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-yellow-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-yellow-500 uppercase tracking-wider">
                                Balasan Admin
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900 divide-y divide-gray-800">
                        @forelse($inquiries as $inquiry)
                            <tr class="hover:bg-gray-800/50 transition duration-150">
                                {{-- Tanggal --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                    {{ $inquiry->created_at->format('d M Y') }}<br>
                                    <span class="text-xs text-gray-600">{{ $inquiry->created_at->format('H:i') }} WIB</span>
                                </td>

                                {{-- Pesan --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-white mb-1">
                                        {{ $inquiry->subject }}
                                    </div>
                                    <p class="text-xs text-gray-400 line-clamp-2 max-w-xs">
                                        "{{ $inquiry->message }}"
                                    </p>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusClass = match($inquiry->status) {
                                            'new' => 'bg-yellow-500/20 text-yellow-500 border-yellow-500/50',
                                            'read' => 'bg-blue-500/20 text-blue-400 border-blue-500/50',
                                            'replied' => 'bg-green-500/20 text-green-400 border-green-500/50',
                                            default => 'bg-gray-700 text-gray-300',
                                        };
                                        $statusLabel = match($inquiry->status) {
                                            'new' => 'Terkirim',
                                            'read' => 'Sedang Diproses',
                                            'replied' => 'Dibalas',
                                            default => ucfirst($inquiry->status),
                                        };
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>

                                {{-- Balasan Admin (Mengambil dari kolom Notes) --}}
                                <td class="px-6 py-4">
                                    @if($inquiry->notes)
                                        <div class="flex items-start gap-2 bg-gray-800/50 p-3 rounded-lg border border-gray-700">
                                            <span class="text-lg">💬</span>
                                            <div>
                                                <p class="text-sm text-white">{{ $inquiry->notes }}</p>
                                                <p class="text-xs text-gray-500 mt-1">Dibalas: {{ $inquiry->updated_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-600 italic">Menunggu respon admin...</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-700 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                        </svg>
                                        <p class="text-gray-500">Kamu belum pernah mengirim pesan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            @if($inquiries->hasPages())
                <div class="px-6 py-4 border-t border-gray-800">
                    {{ $inquiries->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection