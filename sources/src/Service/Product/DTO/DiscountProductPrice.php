<?php

declare(strict_types=1);


namespace App\Service\Product\DTO;

use App\Collection\ArrayInterface;
use App\Service\Product\Currency;

class DiscountProductPrice implements ArrayInterface
{
    private int $original;
    private int $final;
    private ?string $percentage;
    private string $currency;

    public function __construct(
        int $original,
        int $final,
        ?string $percentage,
        string $currency = Currency::EUR
    )
    {
        $this->original = $original;
        $this->final = $final;
        $this->percentage = $percentage;
        $this->currency = $currency;
    }

    public function getOriginal(): int
    {
        return $this->original;
    }

    public function getFinal(): int
    {
        return $this->final;
    }

    public function getPercentage():? string
    {
        return $this->percentage;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function toArray(): array
    {
        return [
            'original' => $this->original,
            'final' => $this->final,
            'discount_percentage' => $this->percentage,
            'currency' => $this->currency
        ];
    }
}