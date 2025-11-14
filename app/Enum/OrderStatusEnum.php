<?php

namespace App\Enum;

enum OrderStatusEnum: string
{
    case Pending = 'pending';
    case Processing = 'processing'; // in delivery and payment
    case Completed = 'completed';
    case Cancelled= 'cancelled';
}
