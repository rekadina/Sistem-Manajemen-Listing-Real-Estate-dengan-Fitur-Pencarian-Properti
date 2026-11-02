<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    // Menampilkan daftar pesan
    public function index(Request $request)
    {
        // PERBAIKAN: Menggunakan query() biasa, bukan filter()
        // 1. Mulai Query
        $query = Inquiry::query();

        // 2. Filter Status (Jika dipilih)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Opsional: Jika ingin menambahkan pencarian (Search) manual
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        //3. Ambil data terbaru dengan pagination
        $inquiries = $query->latest()->paginate(10);
        
        // 4. Agar filter tidak hilang saat pindah halaman (Page 2, 3, dst)
        $inquiries->appends($request->all());

        return view('admin.inquiries.index', compact('inquiries'));
    }

    // Menampilkan Detail
    public function show($id)
    {
        $inquiry = Inquiry::with('property')->findOrFail($id);
        return view('admin.inquiries.show', compact('inquiry'));
    }

    // Hapus Pesan
    public function destroy($id)
    {
        Inquiry::findOrFail($id)->delete();
        return back()->with('success', 'Inquiry berhasil dihapus.');
    }

    // Update Status
    public function updateStatus(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);
        
        // Validasi input status agar aman
        $request->validate([
            'status' => 'required|in:pending,read,responded' // sesuaikan dengan enum database kamu
        ]);

        $inquiry->update(['status' => $request->status]);
        
        return back()->with('success', 'Status inquiry diperbarui.');
    }

    // Tambah Catatan
    public function addNotes(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->update(['notes' => $request->notes]);
        
        return back()->with('success', 'Catatan berhasil disimpan.');
    }
}