<?php

declare(strict_types=1);

namespace App\Controller;

use App\Response\Product\ListResponse;
use App\UseCase\ProductUseCase;
use App\UseCase\Request\ProductRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    private ProductUseCase $productUseCase;

    public function __construct(
        ProductUseCase $productUseCase
    )
    {
        $this->productUseCase = $productUseCase;
    }

    public function index(ProductRequest $request): ListResponse
    {
        $productsCollection = $this->productUseCase->get($request);

        return new ListResponse($productsCollection);
    }
}