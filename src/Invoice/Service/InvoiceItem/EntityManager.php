<?php

namespace App\Invoice\Service\InvoiceItem;

use App\Invoice\DTO\InvoiceItem\CreateInvoiceItemDTO;
use App\Invoice\DTO\InvoiceItem\UpdateInvoiceItemDTO;
use App\Invoice\Entity\Invoice;
use App\Invoice\Entity\InvoiceItem;
use Doctrine\ORM\EntityManagerInterface;

readonly class EntityManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function create(CreateInvoiceItemDTO $createInvoiceItemDTO, Invoice $invoice): InvoiceItem
    {
        $entity = new InvoiceItem();
        $this->setAttributes($createInvoiceItemDTO, $entity);
        $invoice->addItem($entity);


        $this->createEntity($entity);
        return $entity;
    }

    public function update(UpdateInvoiceItemDTO $updateInvoiceItemDTO, InvoiceItem $entity): InvoiceItem
    {
        $this->setAttributes($updateInvoiceItemDTO, $entity);
        $this->updateEntity($entity);
        return $entity;
    }

    public function delete(InvoiceItem $entity): void
    {
        $this->deleteEntity($entity);
    }

    protected function setAttributes(CreateInvoiceItemDTO $createInvoiceItemDTO, InvoiceItem $entity): void
    {
        $entity->setName($createInvoiceItemDTO->getName());
        $entity->setAmount($createInvoiceItemDTO->getAmount());
        $entity->setPrice($createInvoiceItemDTO->getPrice());
    }

    protected function createEntity(InvoiceItem $entity, bool $flush = true): void
    {
        $em = $this->getEntityManager();

        $em->persist($entity);
        if ($flush) {
            $em->flush();
        }
    }

    protected function updateEntity(InvoiceItem $entity, bool $flush = true): void
    {
        $em = $this->getEntityManager();

        if ($flush) {
            $em->flush();
        }
    }

    protected function deleteEntity(InvoiceItem $entity, bool $flush = true): void
    {
        $em = $this->getEntityManager();

        $em->remove($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }
}
