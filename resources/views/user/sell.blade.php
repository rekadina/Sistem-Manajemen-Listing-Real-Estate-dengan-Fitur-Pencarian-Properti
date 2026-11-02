@extends('layouts.app')

@section('title', 'List Your Property - LuxuryEstate')

@section('content')
<div class="bg-black min-h-screen py-16">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Jual Properti <span class="text-yellow-500">Anda</span>
            </h1>
            <p class="text-gray-400">Isi formulir ini untuk mengajukan penjualan properti Anda.</p>
        </div>

        <div class="max-w-4xl mx-auto bg-gray-900 border border-gray-800 rounded-2xl p-8 shadow-2xl">
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="subject" value="Pengajuan List Properti Baru">

                <div class="space-y-4">
                    <div>
                        <label class="text-white">Lokasi Properti</label>
                        <input type="text" name="location" class="w-full bg-black border border-gray-700 text-white rounded p-3" required>
                    </div>
                    <div>
                        <label class="text-white">Jenis Properti</label>
                        <select name="property_type" class="w-full bg-black border border-gray-700 text-white rounded p-3">
                            <option>Rumah</option>
                            <option>Apartemen</option>
                            <option>Tanah</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-white">Harga (Rp)</label>
                        <input type="text" name="price_range" class="w-full bg-black border border-gray-700 text-white rounded p-3" required>
                    </div>
                    <div>
                        <label class="text-white">Detail Tambahan</label>
                        <textarea name="message" rows="4" class="w-full bg-black border border-gray-700 text-white rounded p-3" required></textarea>
                    </div>
                </div>

                <button type="submit" class="w-full bg-yellow-500 text-black font-bold py-3 rounded hover:bg-yellow-400">
                    Ajukan Properti
                </button>
            </form>
        </div>
    </div>
</div>
@endsection