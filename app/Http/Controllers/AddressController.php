<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    // address should be checked before storing
    // address with same city, country, state, street_address_1, street_address_2 should not be stored
    // concept is that if order is placed, then address should be checked
    // user can use previously saved his/her address


    public function allIndex()
    {
        $addresses = Address::with('user')->get();
        info($addresses);
        return view('admin.addresses.index', compact('addresses'));
    }

    public function index(User $user)
    {
        $addresses = $user->addresses()->get();
        return view('admin.addresses.index', compact('addresses'));
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'street_address_1' => 'required|string|max:255',
            'street_address_2' => 'nullable|string|max:255',
        ]);

        $existingAddress = $user->addresses()
            ->where('country', $validated['country'])
            ->where('city', $validated['city'])
            ->where('state', $validated['state'])
            ->where('street_address_1', $validated['street_address_1'])
            ->where('street_address_2', $validated['street_address_2'] ?? '')
            ->first();

        if ($existingAddress) {
            return redirect()->back()->with('error', 'This address already exists.');
        }

        if ($user->addresses()->count() >= 5) {
            return redirect()->back()->with('error', 'You can not add more than 5 addresses.');
        }

        $user->addresses()->create($validated);

        return redirect()->back()->with('success', 'Address added successfully');
    }

    public function update(Request $request, User $user, Address $address)
    {
        if (!$user->addresses()->where('id', $address->id)->exists()) {
            return redirect()->back()->with('error', 'Address not found.');
        }

        $validated = $request->validate([
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'street_address_1' => 'required|string|max:255',
            'street_address_2' => 'nullable|string|max:255',
        ]);

        $existingAddress = $user->addresses()
            ->where('id', '!=', $address->id)
            ->where('country', $validated['country'])
            ->where('city', $validated['city'])
            ->where('state', $validated['state'])
            ->where('street_address_1', $validated['street_address_1'])
            ->where('street_address_2', $validated['street_address_2'] ?? '')
            ->first();

        if ($existingAddress) {
            return redirect()->back()->with('error', 'This address already exists.');
        }

        $address->update($validated);

        return redirect()->back()->with('success', 'Address updated successfully');
    }

    public function destroy(User $user, Address $address)
    {
        if (!$user->addresses()->where('id', $address->id)->exists()) {
            return redirect()->back()->with('error', 'Address not found.');
        }

        $address->delete();

        return redirect()->back()->with('success', 'Address deleted successfully');
    }
}