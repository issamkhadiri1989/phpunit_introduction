<?php

declare(strict_types=1);

namespace App;

class Invoice
{
    public function computeTotalPriceWithTax(float $freeTaxAmount): float
    {
        return $freeTaxAmount * 1.2;
    }
}
