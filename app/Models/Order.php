<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $appends = ['total'];

    protected $fillable = [
        'user_id',
        'shipping_country',
        'shipping_state',
        'shipping_city',
        'shipping_street_address_1',
        'shipping_street_address_2',
        'status',
        'tax_amount',
        'service_charge',
        'delivery_charge',
        'total_amount',
        'coupon_id',
        'discount_amount',
    ];

    public function getTotalAttribute(): float
    {
        // If total_amount is stored in DB, use it. 
        // The accessor for total_amount returns float (NPR).
        if ($this->total_amount !== null) {
            return $this->total_amount;
        }
        
        // Fallback for legacy orders: sum of items (which are stored in paisa)
        $totalPaisa = 0;
        foreach ($this->orderItems as $orderItem) {
            // orderItem->total() returns paisa (int)
            $totalPaisa += $orderItem->total();
        }
        
        // Convert to NPR
        return $totalPaisa / 100;
    }

    protected function taxAmount(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (float $value) => $value * 100,
        );
    }

    protected function serviceCharge(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (float $value) => $value * 100,
        );
    }

    protected function deliveryCharge(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (float $value) => $value * 100,
        );
    }

    public function getTotalAmountAttribute($value)
    {
        return $value !== null ? $value / 100 : null;
    }

    public function setTotalAmountAttribute($value)
    {
        $this->attributes['total_amount'] = $value * 100;
    }

    public function getAddressAttribute()
    {
        return (object) [
            'country' => $this->shipping_country,
            'state' => $this->shipping_state,
            'city' => $this->shipping_city,
            'street_address_1' => $this->shipping_street_address_1,
            'street_address_2' => $this->shipping_street_address_2,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    protected function discountAmount(): Attribute
    {
        return Attribute::make(
            get: fn (?int $value) => $value ? $value / 100 : 0,
            set: fn (float $value) => $value * 100,
        );
    }

    public function snapshotAddress(Address $address): void
    {
        $this->update([
            'shipping_country' => $address->country,
            'shipping_state' => $address->state,
            'shipping_city' => $address->city,
            'shipping_street_address_1' => $address->street_address_1,
            'shipping_street_address_2' => $address->street_address_2,
        ]);
    }
}
