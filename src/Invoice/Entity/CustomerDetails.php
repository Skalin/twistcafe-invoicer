<?php

namespace App\Invoice\Entity;

use App\Shared\Doctrine\ORM\Mapping\IntIdIdentifier;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class CustomerDetails
{
    use IntIdIdentifier;

    #[Column(type: 'string')]
    private string $name;

    #[Column(type: 'string')]
    private string $surname;

    #[Column(type: 'string')]
    private string $email;

    #[Column(type: 'string')]
    private string $phone;

    #[Column(type: 'string')]
    private string $cinNumber;

    #[Column(type: 'string')]
    private string $taxNumber;

    public function getCinNumber(): string
    {
        return $this->cinNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setCinNumber(string $cinNumber): void
    {
        $this->cinNumber = $cinNumber;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function setTaxNumber(string $taxNumber): void
    {
        $this->taxNumber = $taxNumber;
    }

    public function getFullName(): string
    {
        return sprintf('%s %s (%s)', $this->name, $this->surname, $this->cinNumber);
    }
}
