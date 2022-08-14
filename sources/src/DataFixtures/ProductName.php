<?php

declare(strict_types=1);


namespace App\DataFixtures;

use App\Exception\InvalidValueException;

class ProductName
{
    const BV_BOOTS = 'BV Lean leather ankle boots';
    const ASHLINGTON_BOOTS = 'Ashlington leather ankle boots';
    const NAIMA_SANDALS = 'Naima embellished suede sandals';
    const NATHANE_SNEAKERS= 'Nathane leahter sneakers';

    const CONST_COUNT = 4;

    /**
     * @return string
     */
    public static function get(): string
    {
        $rand = rand(0, self::CONST_COUNT - 1);
        $all = self::all();
        if (!array_key_exists($rand, $all)) {
            return self::BV_BOOTS;
        }

        return $all[$rand];
    }

    /**
     * @return string[]
     */
    public static function all(): array
    {
        return [
            self::BV_BOOTS,
            self::ASHLINGTON_BOOTS,
            self::NAIMA_SANDALS,
            self::NATHANE_SNEAKERS,
        ];
    }
}