<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Inquiry; // <--- PENTING: Pakai Inquiry, bukan Contact
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Show contact form
     */
    public function index()
    {
        // Ambil data FAQ (Jika tabel FAQ ada)
        // Jika belum ada tabel FAQ, hapus bagian ini dan ganti $faqs = [];
        try {
            $faqs = FAQ::where('is_active', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            $faqs = []; // Kosongkan jika terjadi error database FAQ
        }

        return view('contact', compact('faqs'));
    }

    /**
     * Handle contact form submission
     */
    public function submit(Request $request)
{
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $request->validate([
        'message' => 'required|string',
    ]);

    // Gabungkan data properti ke dalam pesan (jika ada input dari halaman Sell)
    $finalMessage = $request->message;
    
    if ($request->has('location')) {
        $finalMessage = "LOKASI: " . $request->location . "\n" .
                        "TIPE: " . $request->property_type . "\n" .
                        "HARGA: " . $request->price_range . "\n\n" .
                        "PESAN USER: \n" . $request->message;
    }

    Inquiry::create([
        'user_id' => auth()->id(),
        'name'    => auth()->user()->name,
        'email'   => auth()->user()->email,
        'phone'   => auth()->user()->phone ?? null,
        'subject' => $request->subject ?? 'General Inquiry', // Akan otomatis terisi "Pengajuan List Properti Baru"
        'message' => $finalMessage, // Pesan yang sudah digabung
        'status'  => 'new',
    ]);

    return back()->with('success', 'Pengajuan properti berhasil dikirim! Tim kami akan segera menghubungi Anda.');
    }
}