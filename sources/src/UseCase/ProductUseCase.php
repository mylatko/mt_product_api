<?php

declare(strict_types=1);


namespace App\UseCase;

use App\Service\Discount\DiscountService;
use App\Service\Product\ProductCollection;
use App\Service\Product\Repository\ProductRepository;
use App\UseCase\Request\ProductRequest;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\Expression;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductUseCase extends BaseUseCase
{
    protected ProductRepository $repository;
    protected DiscountService $discountService;

    public function __construct(
        ValidatorInterface $validator,
        ProductRepository $repository,
        DiscountService $discountService
    )
    {
        $this->repository = $repository;
        $this->discountService = $discountService;

        parent::__construct($validator);
    }

    /**
     * @param ProductRequest $request
     * @throws \App\Exception\InvalidValueException
     */
    public function get(ProductRequest $request): ProductCollection
    {
        $this->validateRequest($request);

        $criteria = $this->getCriteriaForProductList($request);

        $products = $this->repository->findByCriteria($criteria);

        return $this->discountService->apply($products);
    }

    private function getCriteriaForProductList(ProductRequest $request): Criteria
    {
        $criteria = new Criteria();

        if ($request->getCategory()) {
            $criteria->andWhere(Criteria::expr()->eq('category', $request->getCategory()));
        }
        if ($request->getPriceLessThan()) {
            $criteria->andWhere(Criteria::expr()->lte('price', $request->getPriceLessThan()));
        }

        return $criteria;
    }
}