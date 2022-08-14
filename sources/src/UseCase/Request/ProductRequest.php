<?php

declare(strict_types=1);


namespace App\UseCase\Request;

use App\Error;
use App\Service\Product\Category;
use App\UseCase\RequestInterface;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class ProductRequest implements RequestInterface
{
    protected ?string $category;
    protected int $priceLessThan;

    public function __construct(
        ?string $category,
        int $priceLessThan
    )
    {
        $this->category = $category;
        $this->priceLessThan = $priceLessThan;
    }

    public function getCategory(): string
    {
        if (null !== $this->category) {
            return ucfirst($this->category);
        }

        return '';
    }

    public function getPriceLessThan(): int
    {
        return $this->priceLessThan;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraints('category', [
            new Choice(Category::all())
        ]);
    }
}