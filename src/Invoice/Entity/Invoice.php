<?php

namespace App\Invoice\Entity;

use App\Invoice\DTO\Price\PriceValue;
use App\Invoice\Enum\Currency;
use App\Invoice\Enum\PaymentMethod;
use App\Shared\Doctrine\ORM\Mapping\IntIdIdentifier;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
class Invoice
{
    use IntIdIdentifier;

    #[Column(unique: true, nullable: false)]
    private string $invoiceNumber;

    #[ManyToOne(targetEntity: CustomerDetails::class)]
    #[JoinColumn(referencedColumnName: 'id', nullable: false)]
    private CustomerDetails $supplier;

    #[ManyToOne(targetEntity: CustomerDetails::class)]
    #[JoinColumn(referencedColumnName: 'id', nullable: false)]
    private CustomerDetails $customer;

    #[Column(nullable: false)]
    private DateTimeImmutable $createdAt;

    #[Column(nullable: false)]
    private DateTimeImmutable $issuedAt;

    #[Column(nullable: false)]
    private DateTimeImmutable $dueAt;

    #[Column(nullable: false)]
    private DateTimeImmutable $taxableSupplyAt;

    #[Column(nullable: false, enumType: PaymentMethod::class)]
    private PaymentMethod $paymentMethod;

    #[Column(nullable: false, enumType: Currency::class)]
    private Currency $currency;

    /** @var Collection<int, InvoiceItem> $items */
    #[OneToMany(targetEntity: InvoiceItem::class, mappedBy: 'invoice', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getTotalPrice(): PriceValue
    {
        return new PriceValue(
            $this->items->reduce(fn (float $total, InvoiceItem $item) => $total + (float) $item->getTotalPrice()->getPrice(), 0),
            $this->currency
        );
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * @return Collection<int, InvoiceItem>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param Collection<int, InvoiceItem> $items
     */
    public function setItems(Collection $items): void
    {
        $this->clearItems();
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    public function clearItems(): void
    {
        $this->items->forAll(function (int $key, InvoiceItem $item) {
            $this->removeItem($item);
            return true;
        });
    }

    public function addItem(InvoiceItem $item): void
    {
        $this->items->add($item);
        $item->setInvoice($this);
    }

    public function removeItem(InvoiceItem $item): void
    {
        $this->items->removeElement($item);
        $item->setInvoice(null);
    }

    /**
     * @param CustomerDetails $customer
     */
    public function setCustomer(CustomerDetails $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return CustomerDetails
     */
    public function getCustomer(): CustomerDetails
    {
        return $this->customer;
    }

    /**
     * @param CustomerDetails $supplier
     */
    public function setSupplier(CustomerDetails $supplier): void
    {
        $this->supplier = $supplier;
    }

    /**
     * @return CustomerDetails
     */
    public function getSupplier(): CustomerDetails
    {
        return $this->supplier;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getTaxableSupplyAt(): DateTimeImmutable
    {
        return $this->taxableSupplyAt;
    }

    /**
     * @param DateTimeImmutable $taxableSupplyAt
     */
    public function setTaxableSupplyAt(DateTimeImmutable $taxableSupplyAt): void
    {
        $this->taxableSupplyAt = $taxableSupplyAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDueAt(): DateTimeImmutable
    {
        return $this->dueAt;
    }

    /**
     * @param DateTimeImmutable $dueAt
     */
    public function setDueAt(DateTimeImmutable $dueAt): void
    {
        $this->dueAt = $dueAt;
    }

    /**
     * @param Currency $currency
     */
    public function setCurrency(Currency $currency): void
    {
        $this->currency = $currency;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(string $invoiceNumber): void
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getIssuedAt(): DateTimeImmutable
    {
        return $this->issuedAt;
    }

    /**
     * @param DateTimeImmutable $issuedAt
     */
    public function setIssuedAt(DateTimeImmutable $issuedAt): void
    {
        $this->issuedAt = $issuedAt;
    }

    /**
     * @return PaymentMethod
     */
    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @param PaymentMethod $paymentMethod
     */
    public function setPaymentMethod(PaymentMethod $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
