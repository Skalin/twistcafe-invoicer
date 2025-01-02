<?php

namespace App\Invoice\DTO\Invoice;

use App\Invoice\Entity\CustomerDetails;
use App\Invoice\Enum\Currency;
use App\Invoice\Enum\PaymentMethod;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CreateInvoiceDTO
{
    #[NotBlank]
    private CustomerDetails $supplier;

    #[NotBlank]
    private CustomerDetails $customer;

    #[NotBlank]
    private \DateTimeImmutable $issuedAt;

    #[NotBlank]
    private \DateTimeImmutable $dueAt;

    #[NotBlank]
    private \DateTimeImmutable $taxableSupplyAt;

    #[NotBlank]
    #[Type(type: PaymentMethod::class)]
    private PaymentMethod $paymentMethod;

    #[NotBlank]
    #[Type(type: Currency::class)]
    private Currency $currency;

    public function getSupplier(): CustomerDetails
    {
        return $this->supplier;
    }

    public function setSupplier(CustomerDetails $supplier): void
    {
        $this->supplier = $supplier;
    }

    public function getCustomer(): CustomerDetails
    {
        return $this->customer;
    }

    public function setCustomer(CustomerDetails $customer): void
    {
        $this->customer = $customer;
    }

    public function getIssuedAt(): \DateTimeImmutable
    {
        return $this->issuedAt;
    }

    public function setIssuedAt(\DateTimeImmutable $issuedAt): void
    {
        $this->issuedAt = $issuedAt;
    }

    public function getDueAt(): \DateTimeImmutable
    {
        return $this->dueAt;
    }

    public function setDueAt(\DateTimeImmutable $dueAt): void
    {
        $this->dueAt = $dueAt;
    }

    public function getTaxableSupplyAt(): \DateTimeImmutable
    {
        return $this->taxableSupplyAt;
    }

    public function setTaxableSupplyAt(\DateTimeImmutable $taxableSupplyAt): void
    {
        $this->taxableSupplyAt = $taxableSupplyAt;
    }

    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(PaymentMethod $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency): void
    {
        $this->currency = $currency;
    }
}
