<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Detail Inquiry</h1>
            <a href="{{ route('admin.inquiries.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Kembali</a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold mb-4">Pesan Dari Customer</h3>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div><label class="text-xs text-gray-500">Nama</label><p class="font-medium">{{ $inquiry->name }}</p></div>
                    <div><label class="text-xs text-gray-500">Email</label><p class="font-medium">{{ $inquiry->email }}</p></div>
                    <div><label class="text-xs text-gray-500">Telepon</label><p class="font-medium">{{ $inquiry->phone ?? '-' }}</p></div>
                    <div><label class="text-xs text-gray-500">Tanggal</label><p class="font-medium">{{ $inquiry->created_at->format('d M Y H:i') }}</p></div>
                </div>
                <div class="border-t pt-4">
                    <label class="text-xs text-gray-500">Subjek</label>
                    <p class="font-bold text-lg mb-2">{{ $inquiry->subject }}</p>
                    <label class="text-xs text-gray-500">Isi Pesan</label>
                    <p class="text-gray-800 bg-gray-50 p-4 rounded-lg mt-1 whitespace-pre-line">{{ $inquiry->message }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold mb-4">Catatan Admin</h3>
                <form action="{{ route('admin.inquiries.add-notes', $inquiry->id) }}" method="POST">
                    @csrf
                    <textarea name="notes" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Tulis catatan internal...">{{ $inquiry->notes }}</textarea>
                    <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan Catatan</button>
                </form>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold mb-4">Update Status</h3>
                <form action="{{ route('admin.inquiries.update-status', $inquiry->id) }}" method="POST" class="grid grid-cols-1 gap-3">
                    @csrf
                    <button type="submit" name="status" value="new" class="p-2 border rounded hover:bg-yellow-50 {{ $inquiry->status == 'new' ? 'border-yellow-500 bg-yellow-50' : '' }}">Baru</button>
                    <button type="submit" name="status" value="contacted" class="p-2 border rounded hover:bg-blue-50 {{ $inquiry->status == 'contacted' ? 'border-blue-500 bg-blue-50' : '' }}">Dihubungi</button>
                    <button type="submit" name="status" value="appointment" class="p-2 border rounded hover:bg-purple-50 {{ $inquiry->status == 'appointment' ? 'border-purple-500 bg-purple-50' : '' }}">Appointment</button>
                    <button type="submit" name="status" value="closed" class="p-2 border rounded hover:bg-gray-50 {{ $inquiry->status == 'closed' ? 'border-gray-500 bg-gray-50' : '' }}">Closed</button>
                </form>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                <a href="mailto:{{ $inquiry->email }}" class="block w-full text-center bg-green-600 text-white py-2 rounded-lg mb-2 hover:bg-green-700">Balas Email</a>
                @if($inquiry->phone)
                    <a href="https://wa.me/{{ $inquiry->phone }}" target="_blank" class="block w-full text-center bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">WhatsApp</a>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>