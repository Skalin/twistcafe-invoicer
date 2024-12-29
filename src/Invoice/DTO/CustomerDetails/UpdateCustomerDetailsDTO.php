<?php

declare(strict_types=1);

namespace App\Invoice\DTO\CustomerDetails;

use App\Invoice\Entity\CustomerDetails;

class UpdateCustomerDetailsDTO extends CreateCustomerDetailsDTO
{
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function hydrateFromEntity(CustomerDetails $entity): void
    {
        $this->setId($entity->getId());
        $this->setName($entity->getName());
        $this->setSurname($entity->getSurname());
        $this->setEmail($entity->getEmail());
        $this->setPhone($entity->getPhone());
        $this->setCinNumber($entity->getCinNumber());
        $this->setTaxNumber($entity->getTaxNumber());
    }
}
