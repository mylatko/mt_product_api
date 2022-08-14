<?php

declare(strict_types=1);


namespace App\Collection;

use App\Exception\InvalidValueException;
use Doctrine\Common\Collections\Collection;
use Closure;
use http\Exception\InvalidArgumentException;

abstract class BaseCollection
{
    protected string $elementClass;

    protected array $elements;

    public function __construct($elements)
    {
        $class = $this->elementClass;

        if (!class_exists($class) && !interface_exists($class)) {
            throw new InvalidArgumentException('Wrong element class name');
        }

        foreach ($elements as $element) {
            if (!$element instanceof $class) {
                throw new InvalidArgumentException("All collection elements must be instance of $class");
            }
        }

        $this->elements = $elements;
    }

    public function toArray()
    {
        $result = [];

        foreach ($this->elements as $item) {
            $result[] = $item->toArray();
        }

        return $result;
    }
}