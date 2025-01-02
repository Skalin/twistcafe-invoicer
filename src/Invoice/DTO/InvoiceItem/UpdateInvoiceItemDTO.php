<?php

declare(strict_types=1);

namespace App\Invoice\DTO\InvoiceItem;

use App\Invoice\DTO\Price\PriceValue;
use App\Invoice\Entity\InvoiceItem;
use App\Invoice\Enum\Currency;

class UpdateInvoiceItemDTO extends CreateInvoiceItemDTO
{
    private int $id;

    private Currency $currency;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setCurrency(Currency $currency): void
    {
        $this->currency = $currency;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getTotalPrice(): PriceValue
    {
        return new PriceValue($this->getAmount() * $this->getPrice(), $this->getCurrency());
    }

    public function hydrateFromEntity(InvoiceItem $entity): void
    {
        $this->setId($entity->getId());
        $this->setAmount($entity->getAmount());
        $this->setName($entity->getName());
        $this->setPrice($entity->getPrice());
    }
}
