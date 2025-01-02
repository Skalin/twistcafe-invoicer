<?php

namespace App\Invoice\DTO\Price;

use App\Invoice\Enum\Currency;
use Symfony\Component\Intl\Currencies;

class PriceValue
{
    private int $decimalPlaces = 2;

    private ?string $decimalSeparator = null;

    private ?string $thousandsSeparator = null;

    public function __construct(private readonly float $price, private readonly Currency $currency)
    {
    }

    public function getPrice(): string
    {
        return (string) number_format($this->price, $this->decimalPlaces, $this->decimalSeparator, $this->thousandsSeparator);
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function __toString(): string
    {
        return sprintf("%s %s", $this->getPrice(), Currencies::getSymbol($this->currency->name));
    }

    public function getDecimalPlaces(): int
    {
        return $this->decimalPlaces;
    }

    public function setDecimalPlaces(int $decimalPlaces): self
    {
        $this->decimalPlaces = $decimalPlaces;
        return $this;
    }

    public function getDecimalSeparator(): ?string
    {
        return $this->decimalSeparator;
    }

    public function getThousandsSeparator(): ?string
    {
        return $this->thousandsSeparator;
    }

    public function setDecimalSeparator(?string $decimalSeparator): self
    {
        $this->decimalSeparator = $decimalSeparator;
        return $this;
    }

    public function setThousandsSeparator(?string $thousandsSeparator): self
    {
        $this->thousandsSeparator = $thousandsSeparator;
        return $this;
    }
}
