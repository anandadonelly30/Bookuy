<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        // Implementasi penyimpanan item akan ditambahkan di sini
        return redirect('/')->with('status', 'Produk berhasil diposting!');
    }
}
