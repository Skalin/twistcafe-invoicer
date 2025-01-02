<?php

namespace App\Invoice\Service\Invoice;

use App\Invoice\DTO\Invoice\CreateInvoiceDTO;
use App\Invoice\DTO\Invoice\UpdateInvoiceDTO;
use App\Invoice\Entity\Invoice;
use App\Invoice\Repository\Invoice\InvoiceNumberGenerator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

readonly class EntityManager
{
    public function __construct(private EntityManagerInterface $entityManager, private InvoiceNumberGenerator $invoiceNumberGenerator)
    {
    }

    public function create(CreateInvoiceDTO $createInvoiceDTO): Invoice
    {
        $entity = new Invoice();
        $this->setAttributes($createInvoiceDTO, $entity);
        $entity->setInvoiceNumber($this->invoiceNumberGenerator->getNextInvoiceNumber());
        $entity->setCreatedAt(new \DateTimeImmutable());
        $entity->setItems(new ArrayCollection());

        $this->createEntity($entity);
        return $entity;
    }

    public function update(UpdateInvoiceDTO $updateInvoiceDTO, Invoice $entity): Invoice
    {
        $this->setAttributes($updateInvoiceDTO, $entity);
        $this->updateEntity($entity);
        return $entity;
    }

    protected function setAttributes(CreateInvoiceDTO $createInvoiceDTO, Invoice $entity): void
    {
        $entity->setSupplier($createInvoiceDTO->getSupplier());
        $entity->setCustomer($createInvoiceDTO->getCustomer());
        $entity->setCurrency($createInvoiceDTO->getCurrency());
        $entity->setPaymentMethod($createInvoiceDTO->getPaymentMethod());
        $entity->setDueAt(\DateTimeImmutable::createFromInterface($createInvoiceDTO->getDueAt()));
        $entity->setTaxableSupplyAt(\DateTimeImmutable::createFromInterface($createInvoiceDTO->getTaxableSupplyAt()));
        $entity->setIssuedAt(\DateTimeImmutable::createFromInterface($createInvoiceDTO->getIssuedAt()));
    }

    protected function createEntity(Invoice $entity, bool $flush = true): void
    {
        $em = $this->getEntityManager();

        $em->persist($entity);
        if ($flush) {
            $em->flush();
        }
    }

    protected function updateEntity(Invoice $entity, bool $flush = true): void
    {
        $em = $this->getEntityManager();

        if ($flush) {
            $em->flush();
        }
    }

    protected function deleteEntity(Invoice $entity, bool $flush = true): void
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
