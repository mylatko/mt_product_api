<?php

declare(strict_types=1);


namespace App\Service\Discount;

use App\Service\Product\DTO\DiscountProduct;
use App\Service\Product\DTO\DiscountProductPrice;
use App\Service\Product\Entity\Product;
use App\Service\Product\ProductCollection;

class DiscountService
{
    private Discounts $discount;

    public function __construct(
        Discounts $discount
    )
    {
        $this->discount = $discount;
    }

    /**
     * @param array<Product> $products
     * @return ProductCollection
     */
    public function apply(array $products): ProductCollection
    {
        $discountedProducts = [];
        foreach($products as $product) {
            $discount = $this->discount->get($product);

            $discountedProducts[] = new DiscountProduct(
                $product->getSku(),
                $product->getName(),
                $product->getCategory(),
                new DiscountProductPrice(
                    $product->getPrice(),
                    intval((null !== $discount) ? ((100 - $discount) * $product->getPrice() / 100) : $product->getPrice()),
                    $discount . "%"
                )
            );
        }

        return new ProductCollection($discountedProducts);
    }
}