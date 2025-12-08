<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $query = Coupon::query();
        
        if ($request->has('search') && $request->search) {
            $query->where('code', 'like', '%' . $request->search . '%');
        }
        
        $coupons = $query->latest()->paginate(15);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:coupons,code|max:50',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_purchase' => 'nullable|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'expires_at' => 'nullable|date|after:today',
            'is_active' => 'boolean',
        ]);

        // Convert code to uppercase
        $validated['code'] = strtoupper($validated['code']);
        
        // Convert min_purchase to paisa if provided
        if (isset($validated['min_purchase'])) {
            $validated['min_purchase'] = (int)($validated['min_purchase'] * 100);
        }

        // Set is_active default if not provided
        $validated['is_active'] = $request->has('is_active') ? true : false;

        Coupon::create($validated);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon created successfully.');
    }

    public function show(Coupon $coupon)
    {
        return view('admin.coupons.show', compact('coupon'));
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_purchase' => 'nullable|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'expires_at' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        // Convert code to uppercase
        $validated['code'] = strtoupper($validated['code']);
        
        // Convert min_purchase to paisa if provided
        if (isset($validated['min_purchase'])) {
            $validated['min_purchase'] = (int)($validated['min_purchase'] * 100);
        }

        // Set is_active
        $validated['is_active'] = $request->has('is_active') ? true : false;

        $coupon->update($validated);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon deleted successfully.');
    }
}
