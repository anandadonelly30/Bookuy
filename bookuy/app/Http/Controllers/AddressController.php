<?php


// FILE: app/Http/Controllers/AddressController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class AddressController extends Controller
{
    // == USE CASE: ManageAddress (View List) ==
    public function index()
    {
        $addresses = Auth::user()->addresses;
        return view('address.index', compact('addresses'));
    }

    // == USE CASE: ManageAddress (View Create Form) ==
    public function create()
    {
        return view('address.create');
    }

    // == USE CASE: ManageAddress (Store New) ==
    public function store(Request $request)
    {
        $request->validate([
            'nickname' => 'required|string|max:255',
            'full_address' => 'required|string',
            'phone_number' => 'required|string|max:20',
        ]);

        $user = Auth::user();

        // Jika ini alamat pertama, jadikan default
        $isDefault = $user->addresses()->count() == 0;
        
        // Jika user mencentang "is_default"
        if ($request->is_default) {
            // Set semua alamat lain jadi non-default
            $user->addresses()->update(['is_default' => false]);
            $isDefault = true;
        }

        $user->addresses()->create([
            'nickname' => $request->nickname,
            'full_address' => $request->full_address,
            'phone_number' => $request->phone_number,
            'department' => $request->department,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'is_default' => $isDefault,
        ]);

        return redirect()->route('address.create')->with('success', 'Your address success to saved');
    }

    // (Edit, Update, Destroy bisa ditambahkan dengan logika serupa)
    public function edit(Address $address)
    {
        // Logika untuk form edit
    }
    
    public function update(Request $request, Address $address)
    {
        // Logika untuk update
    }
    
    public function destroy(Address $address)
    {
        // Logika untuk hapus
    }
    
    public function setDefault(Address $address)
    {
        // Pastikan alamat milik user
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        // Set semua jadi false dulu
        Auth::user()->addresses()->update(['is_default' => false]);

        // Set yang ini jadi true
        $address->update(['is_default' => true]);
        
        return redirect()->back()->with('success', 'Alamat default diubah.');
    }
}