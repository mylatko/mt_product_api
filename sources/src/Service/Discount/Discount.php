<?php

declare(strict_types=1);


namespace App\Service\Discount;

class Discount
{
    private string $type;
    private string $sign;
    private string $value;
    private int $discount;

    public function __construct(
        string $type,
        string $sign,
        string $value,
        int $discount
    )
    {
        $this->type = $type;
        $this->sign = $sign;
        $this->value = $value;
        $this->discount = $discount;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSign(): string
    {
        return $this->sign;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getDiscount(): int
    {
        return $this->discount;
    }
}