<?php


// FILE: app/Http/Controllers/AddressController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * View list of user addresses.
     * 
     * USE CASE: ManageAddress (View List)
     * Displays all addresses belonging to the authenticated user.
     */
    public function viewUserAddresses()
    {
        $addresses = Auth::user()->addresses;
        return view('address.index', compact('addresses'));
    }

    /**
     * Show the form to create a new address.
     * 
     * USE CASE: ManageAddress (View Create Form)
     * Displays the form where users can input new address information.
     */
    public function showCreateAddressForm()
    {
        return view('address.create');
    }

    /**
     * Create and save a new address to the database.
     * 
     * USE CASE: ManageAddress (Store New)
     * Validates input, maps fields to class diagram schema,
     * handles default address logic, and saves the new address.
     */
    public function createNewAddress(Request $request)
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

        // Map form fields to class diagram field names
        $user->addresses()->create([
            'label_address' => $request->nickname,  // Map nickname to label_address (class diagram field)
            'receiver_name' => $user->username,     // Required field from class diagram
            'full_address' => $request->full_address,
            'phone_number' => $request->phone_number,
            'department' => $request->department,
            'street' => $request->street ?? '',    // New fields from class diagram
            'city' => $request->city ?? '',        // New fields from class diagram
            'province' => $request->province ?? '', // New fields from class diagram
            'postal_code' => $request->postal_code ?? '', // New fields from class diagram
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'is_default' => $isDefault,
        ]);

        return redirect()->route('address.create')->with('success', 'Your address success to saved');
    }

    /**
     * Show the form to edit an existing address.
     * 
     * USE CASE: ManageAddress (Edit)
     * Displays the form pre-filled with current address data.
     */
    public function showEditAddressForm(Address $address)
    {
        // Ensure address belongs to authenticated user
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('address.edit', compact('address'));
    }
    
    /**
     * Update an existing address in the database.
     * 
     * USE CASE: ManageAddress (Update)
     * Validates input and updates the address with new information.
     */
    public function updateExistingAddress(Request $request, Address $address)
    {
        // Ensure address belongs to authenticated user
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'nickname' => 'required|string|max:255',
            'full_address' => 'required|string',
            'phone_number' => 'required|string|max:20',
        ]);
        
        // Map form fields to class diagram field names
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
    
    /**
     * Delete an address from the database.
     * 
     * USE CASE: ManageAddress (Delete)
     * Removes the address permanently. If it was the default,
     * automatically sets another address as default.
     */
    public function deleteAddress(Address $address)
    {
        // Ensure address belongs to authenticated user
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $wasDefault = $address->is_default;
        $address->delete();
        
        // If deleted address was default, set another as default
        if ($wasDefault) {
            $firstAddress = Auth::user()->addresses()->first();
            if ($firstAddress) {
                $firstAddress->update(['is_default' => true]);
            }
        }
        
        return redirect()->route('address.index')->with('success', 'Address deleted successfully');
    }
    
    /**
     * Mark a specific address as the default address.
     * 
     * USE CASE: ManageAddress (Set Default)
     * Sets all addresses to non-default, then marks the selected one as default.
     */
    public function markAddressAsDefault(Address $address)
    {
        // Ensure address belongs to authenticated user
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Set all addresses to non-default first
        Auth::user()->addresses()->update(['is_default' => false]);

        // Mark this address as default
        $address->update(['is_default' => true]);
        
        return redirect()->back()->with('success', 'Default address has been changed successfully.');
    }
}