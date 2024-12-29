<?php

namespace App\Invoice\Service\CustomerDetails;

use App\Invoice\DTO\CustomerDetails\CreateCustomerDetailsDTO;
use App\Invoice\DTO\CustomerDetails\UpdateCustomerDetailsDTO;
use App\Invoice\Entity\CustomerDetails;
use Doctrine\ORM\EntityManagerInterface;

readonly class EntityManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function create(CreateCustomerDetailsDTO $createCustomerDetailsDTO): CustomerDetails
    {
        $entity = new CustomerDetails();
        $entity->setName($createCustomerDetailsDTO->getName());
        $entity->setSurname($createCustomerDetailsDTO->getSurname());
        $entity->setEmail($createCustomerDetailsDTO->getEmail());
        $entity->setPhone($createCustomerDetailsDTO->getPhone());
        $entity->setCinNumber((string) $createCustomerDetailsDTO->getCinNumber());
        $entity->setTaxNumber((string) $createCustomerDetailsDTO->getTaxNumber());
        $this->createEntity($entity);
        return $entity;
    }

    public function update(UpdateCustomerDetailsDTO $updateInvoiceDTO, CustomerDetails $entity): CustomerDetails
    {
        $entity->setEmail($updateInvoiceDTO->getEmail());
        $entity->setPhone($updateInvoiceDTO->getPhone());
        $entity->setCinNumber((string) $updateInvoiceDTO->getCinNumber());
        $entity->setTaxNumber((string) $updateInvoiceDTO->getTaxNumber());
        $this->updateEntity($entity);
        return $entity;
    }

    public function delete(CustomerDetails $entity): void
    {
        $this->deleteEntity($entity);
    }

    protected function createEntity(CustomerDetails $entity, bool $flush = true): void
    {
        $em = $this->getEntityManager();

        $em->persist($entity);
        if ($flush) {
            $em->flush();
        }
    }

    protected function updateEntity(CustomerDetails $entity, bool $flush = true): void
    {
        $em = $this->getEntityManager();

        if ($flush) {
            $em->flush();
        }
    }

    protected function deleteEntity(CustomerDetails $entity, bool $flush = true): void
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
