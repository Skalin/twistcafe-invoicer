<?php

namespace App\Invoice\DTO\Invoice;

use App\Invoice\DTO\InvoiceItem\UpdateInvoiceItemDTO;
use App\Invoice\Entity\Invoice;
use Doctrine\Common\Collections\ArrayCollection;

class UpdateInvoiceDTO extends CreateInvoiceDTO
{
    private int $id;

    private readonly string $invoiceNumber;

    /** @var ArrayCollection<int, UpdateInvoiceItemDTO> */
    private ArrayCollection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return ArrayCollection<int, UpdateInvoiceItemDTO>
     */
    public function getItems(): ArrayCollection
    {
        return $this->items;
    }

    private function addItem(UpdateInvoiceItemDTO $item): void
    {
        $this->items->add($item);
    }


    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(string $invoiceNumber): void
    {
        $this->invoiceNumber = $invoiceNumber;
    }


    public function hydrateFromEntity(Invoice $entity): void
    {
        $this->setId($entity->getId());
        $this->setSupplier($entity->getSupplier());
        $this->setCustomer($entity->getCustomer());
        $this->setIssuedAt($entity->getIssuedAt());
        $this->setDueAt($entity->getDueAt());
        $this->setTaxableSupplyAt($entity->getTaxableSupplyAt());
        $this->setPaymentMethod($entity->getPaymentMethod());
        $this->setCurrency($entity->getCurrency());
        $this->setInvoiceNumber($entity->getInvoiceNumber());

        foreach ($entity->getItems() as $item) {
            $dto = new UpdateInvoiceItemDTO();
            $dto->hydrateFromEntity($item);
            $dto->setCurrency($entity->getCurrency());
            $this->addItem($dto);
        }
    }
}
