<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_method',
        'transaction_code',
        'status',
    ];

     protected $casts = [
        'payment_method' => PaymentMethodEnum::class,
        'status' => PaymentStatusEnum::class,
    ];


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
