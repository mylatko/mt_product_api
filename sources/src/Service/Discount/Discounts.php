<?php

declare(strict_types=1);


namespace App\Service\Discount;

use App\Service\Product\Entity\Product;

class Discounts
{
    public static function all()
    {
        return [
            new Discount(
                'category',
                '=',
                'boots',
                30
            ),
            new Discount(
                'sku',
                '=',
                '000003',
                15
            )
        ];
    }

    public function get(Product $product):? int
    {
        $discounts = self::all();

        $resultDiscount = null;
        foreach($discounts as $discount) {
            $newDiscount = $this->getDiscount($discount, $product);
            if($newDiscount > $resultDiscount) {
                $resultDiscount = $newDiscount;
            }
        }

        return $resultDiscount;
    }

    protected function getProductValue(Discount $discount, Product $product): string|int|null
    {
        switch($discount->getType()) {
            case 'sku':
                return $product->getSku();
            case 'category':
                return $product->getCategory();
            case 'name':
                return $product->getName();
            case 'price':
                return $product->getPrice();
            default:
                return null;
        }
    }

    private function getDiscount(Discount $discount, Product $product)
    {
        $productValue = $this->getProductValue($discount, $product);
        if (null == $productValue) {
            return null;
        }
        $discountValue = $discount->getValue();

        switch($discount->getSign()) {
            case '=':
                if ($productValue == $discountValue) {
                    return $discount->getDiscount();
                }
            case '<=':
                if ($productValue <= $discountValue) {
                    return $discount->getDiscount();
                }
            case '>':
                if ($productValue > $discountValue) {
                    return $discount->getDiscount();
                }
            default:
                return null;
        }
    }
}