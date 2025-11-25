<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Implementasi registrasi pengguna akan ditambahkan di sini
        return redirect('/login')->with('status', 'Pendaftaran berhasil!');
    }
}
