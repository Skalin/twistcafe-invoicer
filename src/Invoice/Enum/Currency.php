<?php

namespace App\Invoice\Enum;

enum Currency: string
{
    case EUR = 'EUR';

    case CZK = 'CZK';

    case USD = 'USD';
}
