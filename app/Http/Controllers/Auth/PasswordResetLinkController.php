<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password'); // Anda perlu membuat view ini jika ingin menggunakannya
    }

    public function store(Request $request)
    {
        // Implementasi pengiriman link reset password akan ditambahkan di sini
        return back()->with('status', 'Kami telah mengirimkan link reset password ke email Anda!');
    }
}
