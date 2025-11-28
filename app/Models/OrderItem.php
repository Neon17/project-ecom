<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'amount_per_item',
    ];

    public function total(): int
    {
        return $this->getRawOriginal('amount_per_item') * $this->quantity;
    }

    public function getTotalAttribute(): int
    {
        return $this->total();
    }

    protected function amountPerItem(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (float $value) => $value * 100,
        );
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
