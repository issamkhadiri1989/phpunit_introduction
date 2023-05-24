<?php

declare(strict_types=1);

namespace App\Tests;

use App\Invoice;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Invoice::class)]
class InvoiceTest extends TestCase
{
    public function testTaxIncludedAmount(): void
    {
        $invoice = new Invoice();
        $taxIncludedAmount = $invoice->computeTotalPriceWithTax(100);
        $this->assertEquals(120, $taxIncludedAmount);
    }
}
