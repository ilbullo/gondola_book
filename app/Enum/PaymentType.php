<?php

namespace App\Enum;

enum PaymentType:string {
    case CASH       = 'contanti';
    case POS        = 'pos';
    case INVOICE    = 'fattura';
}
