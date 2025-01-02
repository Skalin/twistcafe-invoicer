<?php

namespace App\Invoice\Entity;

use App\Invoice\DTO\Price\PriceValue;
use App\Shared\Doctrine\ORM\Mapping\IntIdIdentifier;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class InvoiceItem
{
    use IntIdIdentifier;

    #[Column(type: 'string')]
    private string $name;

    #[Column(type: Types::DECIMAL, precision: 12, scale: 2)]
    private string $amount;

    #[Column(type: Types::DECIMAL, precision: 12, scale: 2)]
    private string $price;

    #[ManyToOne(targetEntity: Invoice::class, inversedBy: 'items')]
    #[JoinColumn(referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?Invoice $invoice;

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAmount(): float
    {
        return (float) $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = (string) $amount;
    }

    public function getPrice(): float
    {
        return (float) $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = (string) $price;
    }

    public function getTotalPrice(): PriceValue
    {
        if (!$this->invoice) {
            throw new \LogicException('Invoice is not set');
        }
        return new PriceValue($this->getAmount() * $this->getPrice(), $this->invoice->getCurrency());
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }
}
