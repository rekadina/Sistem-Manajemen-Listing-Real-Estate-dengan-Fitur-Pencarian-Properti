@extends('layouts.app')

@section('title', 'Contact Us - LuxuryEstate')

@section('content')
<div class="bg-black min-h-screen">
    <section class="relative py-20 bg-gradient-to-r from-black via-gray-900 to-black border-b border-yellow-500/20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                    Get in <span class="text-yellow-500">Touch</span>
                </h1>
                <p class="text-xl text-gray-300 mb-4">
                    Hubungi spesialis properti kami untuk layanan eksklusif.
                </p>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="space-y-6">
                    <div class="bg-gradient-to-br from-gray-900 to-black border border-yellow-500/30 rounded-2xl p-8">
                        <h3 class="text-xl font-bold text-white mb-2">Phone</h3>
                        <p class="text-yellow-500 font-semibold text-lg">+62 812-3456-7890</p>
                    </div>

                    <div class="bg-gradient-to-br from-gray-900 to-black border border-yellow-500/30 rounded-2xl p-8">
                        <h3 class="text-xl font-bold text-white mb-2">Email</h3>
                        <p class="text-yellow-500 font-semibold text-lg">info@luxuryestate.com</p>
                    </div>

                    <div class="bg-gradient-to-br from-gray-900 to-black border border-yellow-500/30 rounded-2xl p-8">
                        <h3 class="text-xl font-bold text-white mb-2">Office</h3>
                        <p class="text-gray-300 text-sm">Jakarta Selatan, Indonesia</p>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-gradient-to-br from-gray-900 to-black border border-yellow-500/30 rounded-2xl p-10 shadow-2xl">
                        <h2 class="text-3xl font-bold text-white mb-2 flex items-center gap-2">
                            <span class="text-yellow-500">✉️</span> Kirim Pesan
                        </h2>
                        <p class="text-gray-400 mb-8">Silakan isi formulir di bawah ini.</p>

                        @if(session('success'))
                            <div class="bg-green-500/20 border border-green-500/50 rounded-lg p-4 mb-6">
                                <p class="text-green-400 font-bold">{{ session('success') }}</p>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="bg-red-500/20 border border-red-500/50 rounded-lg p-4 mb-6">
                                <p class="text-red-400 font-bold">{{ session('error') }}</p>
                            </div>
                        @endif

                        {{-- Cek Apakah User Sudah Login? --}}
                        @auth
                            <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
                                @csrf

                                <div class="bg-gray-800/50 p-4 rounded-lg border border-gray-700">
                                    <p class="text-gray-400 text-sm mb-1">Anda mengirim pesan sebagai:</p>
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-yellow-500 flex items-center justify-center text-black font-bold text-xl">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-white font-bold">{{ Auth::user()->name }}</p>
                                            <p class="text-yellow-500 text-sm">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-white font-semibold mb-3">Subject / Judul Pesan *</label>
                                    <input type="text" name="subject" placeholder="Contoh: Tanya harga rumah..." 
                                           class="w-full px-6 py-3 bg-gray-800 border border-gray-700 text-white placeholder-gray-500 rounded-lg focus:outline-none focus:border-yellow-500 transition"
                                           required>
                                </div>

                                <div>
                                    <label class="block text-white font-semibold mb-3">Pesan Anda *</label>
                                    <textarea name="message" placeholder="Tuliskan detail pertanyaan atau kebutuhan Anda di sini..." rows="6"
                                              class="w-full px-6 py-3 bg-gray-800 border border-gray-700 text-white placeholder-gray-500 rounded-lg focus:outline-none focus:border-yellow-500 transition resize-none" required></textarea>
                                </div>

                                <button type="submit" class="w-full bg-gradient-to-r from-yellow-500 to-yellow-600 text-black font-bold py-4 rounded-lg hover:from-yellow-400 hover:to-yellow-500 transition duration-300 transform hover:scale-105 mt-8 text-lg shadow-lg">
                                    Kirim Pesan
                                </button>
                            </form>
                        
                        {{-- Jika User Belum Login --}}
                        @else
                            <div class="text-center py-10 bg-gray-800/30 rounded-xl border border-dashed border-gray-700">
                                <p class="text-gray-300 mb-6 text-lg">Anda harus login terlebih dahulu untuk mengirim pesan kepada kami.</p>
                                <div class="flex gap-4 justify-center">
                                    <a href="{{ route('login') }}" class="bg-yellow-500 text-black px-8 py-3 rounded-lg font-bold hover:bg-yellow-400 transition">
                                        Login Sekarang
                                    </a>
                                    <a href="{{ route('register') }}" class="bg-gray-700 text-white px-8 py-3 rounded-lg font-bold hover:bg-gray-600 transition">
                                        Daftar Akun
                                    </a>
                                </div>
                            </div>
                        @endauth
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(isset($faqs) && count($faqs) > 0)
    <section class="py-20 bg-gray-900 border-t border-yellow-500/20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-white text-center mb-10">FAQ</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                @foreach($faqs as $faq)
                    <div class="bg-black p-6 rounded-xl border border-gray-800">
                        <h3 class="text-yellow-500 font-bold mb-2">{{ $faq->question }}</h3>
                        <p class="text-gray-400">{{ $faq->answer }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
@endsection