<?php

namespace App;

enum PaymentMethodEnum: string
{
    case Cash = 'cash';
    case Card = 'card';
    case Cheque = 'cheque';
    case Wallet = 'wallet';
    case Bank = 'bank';
    case MobileBanking = 'mobileBanking';
}
