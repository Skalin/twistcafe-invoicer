<?php

namespace App\Invoice\Enum;

enum PaymentMethod: string
{
    case BANK_TRANSFER = 'bank_transfer';

    case CASH = 'cash';

    case CARD = 'card';
}
