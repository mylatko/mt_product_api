<?php

declare(strict_types=1);


namespace App\RequestResolver;

use App\UseCase\Request\ProductRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;

class ProductRequestResolver implements ArgumentValueResolverInterface
{

    /**
     * @inheritDoc
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return ProductRequest::class === $argument->getType();
    }

    /**
     * @inheritDoc
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $category = $request->get('category', '');
        $priceLessThan = (int)$request->get('priceLessThan', 0);

        yield new ProductRequest(
            $category,
            $priceLessThan
        );
    }
}