<?php

declare(strict_types=1);

namespace App\Response;

use App\Service\Product\ProductCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListResponse extends JsonResponse
{
    private ProductCollection $products;

    public function __construct(
        ProductCollection $products
    )
    {
        $this->products = $products;

        parent::__construct();
    }

    public function sendContent(): static
    {
        $output = $this->getOutput();
        $this->setData($output);

        return parent::sendContent();
    }

    public function getOutput(): array
    {
        return [
            'data' => $this->products->toArray(),
            'errors' => []
        ];
    }
}