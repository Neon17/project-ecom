<?php

namespace App\Enum;

enum PaymentMethodEnum: string
{
    case Cash = 'cash';
    case Esewa = 'esewa';
    case Khalti = 'khalti';
}
