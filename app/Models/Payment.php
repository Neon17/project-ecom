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
        'invoice_number',
        'status',
        'total_amount',
        'paid_at',
        'failed_at',
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
        'paid_at' => 'datetime',
        'failed_at' => 'datetime',
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

    /**
     * Check if payment has a downloadable invoice
     */
    public function hasInvoice(): bool
    {
        return $this->status === PaymentStatusEnum::Completed;
    }

    /**
     * Generate invoice number for this payment
     */
    public function generateInvoiceNumber(): string
    {
        $prefix = 'INV';
        $year = now()->format('Y');
        $month = now()->format('m');
        $sequence = str_pad($this->id, 6, '0', STR_PAD_LEFT);
        
        return "{$prefix}-{$year}{$month}-{$sequence}";
    }
}

