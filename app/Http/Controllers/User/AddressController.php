<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = auth()->user()->addresses;
        return view('user.addresses.index', compact('addresses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'street_address_1' => 'required|string|max:255',
            'street_address_2' => 'nullable|string|max:255',
        ]);

        if (auth()->user()->addresses()->count() >= 5) {
            return back()->with('error', 'You cannot add more than 5 addresses.');
        }

        auth()->user()->addresses()->create($validated);

        return back()->with('success', 'Address added successfully.');
    }

    public function update(Request $request, Address $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'street_address_1' => 'required|string|max:255',
            'street_address_2' => 'nullable|string|max:255',
        ]);

        $address->update($validated);

        return back()->with('success', 'Address updated successfully.');
    }

    public function destroy(Address $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $address->delete();

        return back()->with('success', 'Address deleted successfully.');
    }
}
