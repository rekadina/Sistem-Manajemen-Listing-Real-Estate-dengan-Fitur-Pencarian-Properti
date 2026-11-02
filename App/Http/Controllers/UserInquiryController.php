<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Auth;

class UserInquiryController extends Controller
{
    /**
     * Tampilkan daftar inquiry milik user yang sedang login
     */
    public function index()
    {
        // Ambil data inquiry dimana user_id = ID user yang login
        $inquiries = Inquiry::where('user_id', Auth::id())
                            ->latest() // Urutkan dari yang terbaru
                            ->paginate(10);

        return view('user.inquiries.index', compact('inquiries'));
    }
}