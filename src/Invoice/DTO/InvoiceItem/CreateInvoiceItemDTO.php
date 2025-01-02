<?php

declare(strict_types=1);

namespace App\Invoice\DTO\InvoiceItem;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class CreateInvoiceItemDTO
{
    #[NotBlank]
    private string $name;

    #[NotBlank]
    #[Positive]
    private float $amount;

    #[NotBlank]
    #[PositiveOrZero]
    private float $price;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}
