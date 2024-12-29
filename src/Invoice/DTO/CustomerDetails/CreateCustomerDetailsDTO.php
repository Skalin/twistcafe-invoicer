<?php

declare(strict_types=1);

namespace App\Invoice\DTO\CustomerDetails;

use Symfony\Component\Validator\Constraints as Assert;

class CreateCustomerDetailsDTO
{
    #[
        Assert\NotBlank,
        Assert\Length(min: 3, max: 255)
    ]
    private string $name;

    #[
        Assert\NotBlank,
        Assert\Length(min: 3, max: 255)
    ]
    private string $surname;

    #[
        Assert\Email,
        Assert\NotBlank,
        Assert\Length(min: 3, max: 255)
    ]
    private string $email;

    #[
        Assert\Length(min: 3, max: 20)
    ]
    #[Assert\NotBlank]
    private string $phone;

    #[
        Assert\Length(min: 8, max: 8)
    ]
    #[Assert\NotBlank]
    private ?string $cinNumber;

    #[
        Assert\Length(min: 10, max: 12)
    ]
    #[Assert\NotBlank]
    private ?string $taxNumber;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getCinNumber(): ?string
    {
        return $this->cinNumber;
    }

    public function setCinNumber(?string $cinNumber): void
    {
        $this->cinNumber = $cinNumber;
    }

    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    public function setTaxNumber(?string $taxNumber): void
    {
        $this->taxNumber = $taxNumber;
    }
}
