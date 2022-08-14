<?php

declare(strict_types=1);


namespace App\Service\Product\DTO;

use App\Collection\ArrayInterface;

class DiscountProduct implements ArrayInterface
{
    private string $sku;
    private string $name;
    private string $category;
    private DiscountProductPrice $price;

    public function __construct(
        string $sku,
        string $name,
        string $category,
        DiscountProductPrice $price
    )
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getPrice(): DiscountProductPrice
    {
        return $this->price;
    }

    public function toArray(): array
    {
        return [
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "category" => $this->getCategory(),
            "price" => $this->getPrice()->toArray()
        ];
    }
}