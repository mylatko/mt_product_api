<?php

declare(strict_types=1);

namespace App\Service\Product;

class Category
{
    const BOOTS = 'boots';
    const SANDALS = 'sandals';
    const SNEAKERS = 'sneakers';

    const CONST_COUNT = 3;

    public static function getRand(): string
    {
        $rand = rand(0, self::CONST_COUNT - 1);
        $all = self::all();
        if (!array_key_exists($rand, $all)) {
            return self::BOOTS;
        }

        return ucfirst($all[$rand]);
    }

    public static function all(): array
    {
        return [
            self::BOOTS,
            self::SANDALS,
            self::SNEAKERS
        ];
    }
}