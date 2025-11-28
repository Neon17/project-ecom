<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_method',
        'transaction_code',
        'status',
        'total_amount',
    ];

    protected function totalAmount(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (float $value) => $value * 100,
        );
    }

    protected $casts = [
        'payment_method' => PaymentMethodEnum::class,
        'status' => PaymentStatusEnum::class,
    ];


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(
            User::class,     
            Order::class,    
            'id',          
            'id',           
            'order_id',     
            'user_id'     
        );
    }
}
