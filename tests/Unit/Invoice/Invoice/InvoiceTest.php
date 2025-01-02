<?php

declare(strict_types=1);


namespace App\Tests\Unit\Invoice\Invoice;

use App\Invoice\DTO\Price\PriceValue;
use App\Invoice\Entity\Invoice;
use App\Invoice\Entity\InvoiceItem;
use App\Invoice\Enum\Currency;
use App\Invoice\Enum\PaymentMethod;
use PHPUnit\Framework\TestCase;

class InvoiceTest extends TestCase
{


    public function testHasZeroItems(): void
    {
        $invoice = new Invoice();
        $this->assertEquals(0, $invoice->getItems()->count());
    }

    public function testHasZeroItemsAfterClear(): void
    {
        $invoice = new Invoice();
        $invoice->setCurrency(Currency::EUR);

        $invoiceItem = new InvoiceItem();
        $invoiceItem->setName('Item 1');
        $invoiceItem->setPrice(100);
        $invoiceItem->setAmount(1);

        $invoice->addItem($invoiceItem);

        $this->assertEquals(1, $invoice->getItems()->count());

        $invoice->clearItems();

        $this->assertEquals(0, $invoice->getItems()->count());
    }

    public function testHasOneItem(): void
    {
        $invoice = new Invoice();
        $invoice->setCurrency(Currency::EUR);
        $invoiceItem = new InvoiceItem();
        $invoiceItem->setName('Item 1');
        $invoiceItem->setPrice(100);
        $invoiceItem->setAmount(1);

        $invoice->addItem($invoiceItem);

        $this->assertEquals(1, $invoice->getItems()->count());
    }


    public function testHasZeroItemsAfterRemove(): void
    {
        $invoice = new Invoice();
        $invoice->setCurrency(Currency::EUR);
        $invoiceItem = new InvoiceItem();
        $invoiceItem->setName('Item 1');
        $invoiceItem->setPrice(100);
        $invoiceItem->setAmount(1);

        $invoice->addItem($invoiceItem);

        $this->assertEquals(1, $invoice->getItems()->count());

        $invoice->removeItem($invoiceItem);

        $this->assertEquals(0, $invoice->getItems()->count());
    }


    public function testCurrencyChange(): void
    {
        $invoice = new Invoice();
        $invoice->setCurrency(Currency::EUR);
        $this->assertEquals(Currency::EUR, $invoice->getCurrency());

        $invoice->setCurrency(Currency::USD);
        $this->assertEquals(Currency::USD, $invoice->getCurrency());
    }

    public function testPaymentMethod(): void
    {
        $invoice = new Invoice();
        $invoice->setPaymentMethod(PaymentMethod::BANK_TRANSFER);
        $this->assertEquals(PaymentMethod::BANK_TRANSFER, $invoice->getPaymentMethod());

        $invoice->setPaymentMethod(PaymentMethod::CARD);
        $this->assertEquals(PaymentMethod::CARD, $invoice->getPaymentMethod());
    }

    public function testTotalPrice(): void
    {
        $invoice = new Invoice();
        $invoice->setCurrency(Currency::EUR);

        $this->assertEquals(new PriceValue(0.00, Currency::EUR), $invoice->getTotalPrice());

        $invoiceItem = new InvoiceItem();
        $invoiceItem->setName('Item 1');
        $invoiceItem->setPrice(100);
        $invoiceItem->setAmount(1);

        $invoice->addItem($invoiceItem);
        $this->assertEquals(new PriceValue(100.00, Currency::EUR), $invoice->getTotalPrice());

        $invoiceItem2 = clone ($invoiceItem);
        $invoice->addItem($invoiceItem2);
        $this->assertEquals(new PriceValue(200.00, Currency::EUR), $invoice->getTotalPrice());

        $invoiceItem3 = clone ($invoiceItem);
        $invoiceItem3->setAmount(2);
        $invoice->addItem($invoiceItem3);

        $this->assertEquals(new PriceValue(400.00, Currency::EUR), $invoice->getTotalPrice());
    }
}