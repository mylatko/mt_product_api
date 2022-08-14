<?php

declare(strict_types=1);


namespace App\Service\Product;

use App\Collection\BaseCollection;
use App\Service\Product\DTO\DiscountProduct;

class ProductCollection extends BaseCollection
{
    protected string $elementClass = DiscountProduct::class;
}