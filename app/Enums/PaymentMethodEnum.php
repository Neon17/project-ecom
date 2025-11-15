<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case Cash = 'cash';
    case Esewa = 'esewa';
    case Khalti = 'khalti';
}
