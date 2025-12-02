<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class AddressController extends Controller
{
    public function viewUserAddresses()
    {
        $addresses = Auth::user()->addresses;
        return view('address.index', compact('addresses'));
    }

    public function showCreateAddressForm()
    {
        return view('address.create');
    }

    public function createNewAddress(Request $request)
    {
        $request->validate([
            'nickname' => 'required|string|max:255',
            'full_address' => 'required|string',
            'phone_number' => 'required|string|max:20',
        ]);

        $user = Auth::user();

        $isDefault = $user->addresses()->count() == 0;
        
        if ($request->is_default) {
            $user->addresses()->update(['is_default' => false]);
            $isDefault = true;
        }

        $user->addresses()->create([
            'label_address' => $request->nickname,
            'receiver_name' => $user->username,
            'full_address' => $request->full_address,
            'phone_number' => $request->phone_number,
            'department' => $request->department,
            'street' => $request->street ?? '',
            'city' => $request->city ?? '',
            'province' => $request->province ?? '',
            'postal_code' => $request->postal_code ?? '',
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'is_default' => $isDefault,
        ]);

        return redirect()->route('address.create')->with('success', 'Your address success to saved');
    }

    public function showEditAddressForm(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('address.edit', compact('address'));
    }
    
    public function updateExistingAddress(Request $request, Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'nickname' => 'required|string|max:255',
            'full_address' => 'required|string',
            'phone_number' => 'required|string|max:20',
        ]);
        
        $address->update([
            'label_address' => $request->nickname,
            'receiver_name' => $request->receiver_name ?? Auth::user()->username,
            'full_address' => $request->full_address,
            'phone_number' => $request->phone_number,
            'department' => $request->department,
            'street' => $request->street ?? '',
            'city' => $request->city ?? '',
            'province' => $request->province ?? '',
            'postal_code' => $request->postal_code ?? '',
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        
        return redirect()->route('address.index')->with('success', 'Address updated successfully');
    }
    
    public function deleteAddress(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $wasDefault = $address->is_default;
        $address->delete();
        
        if ($wasDefault) {
            $firstAddress = Auth::user()->addresses()->first();
            if ($firstAddress) {
                $firstAddress->update(['is_default' => true]);
            }
        }
        
        return redirect()->route('address.index')->with('success', 'Address deleted successfully');
    }
    
    public function markAddressAsDefault(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        Auth::user()->addresses()->update(['is_default' => false]);

        $address->update(['is_default' => true]);
        
        return redirect()->back()->with('success', 'Default address has been changed successfully.');
    }
}