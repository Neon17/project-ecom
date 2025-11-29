<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_purchase',
        'max_uses',
        'used_count',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Orders that used this coupon
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Check if coupon is currently valid
     */
    public function isValid(): bool
    {
        // Check if active
        if (!$this->is_active) {
            return false;
        }

        // Check expiration
        if ($this->expires_at && Carbon::now()->isAfter($this->expires_at)) {
            return false;
        }

        // Check max uses
        if ($this->max_uses && $this->used_count >= $this->max_uses) {
            return false;
        }

        return true;
    }

    /**
     * Check if coupon can be used for given cart total
     */
    public function canBeUsed(int $cartTotal): bool
    {
        if (!$this->isValid()) {
            return false;
        }

        // Check minimum purchase
        if ($this->min_purchase && $cartTotal < $this->min_purchase) {
            return false;
        }

        return true;
    }

    /**
     * Calculate discount amount in paisa
     */
    public function calculateDiscount(int $cartTotal): int
    {
        if ($this->type === 'percentage') {
            // Calculate percentage discount
            $discount = ($cartTotal * $this->value) / 100;
            return (int) round($discount);
        } else {
            // Fixed amount discount (convert NPR to paisa)
            $discountInPaisa = (int) ($this->value * 100);
            // Don't discount more than cart total
            return min($discountInPaisa, $cartTotal);
        }
    }

    /**
     * Increment usage count
     */
    public function incrementUsage(): void
    {
        $this->increment('used_count');
    }

    /**
     * Scope for active coupons
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where(function($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', Carbon::now());
                    });
    }

    /**
     * Scope for available coupons (not maxed out)
     */
    public function scopeAvailable($query)
    {
        return $query->where(function($q) {
            $q->whereNull('max_uses')
              ->orWhereRaw('used_count < max_uses');
        });
    }
}
