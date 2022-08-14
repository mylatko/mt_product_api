<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Service\Product\Category;
use App\Service\Product\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    const MIN_COST = 10;
    const MAX_COST = 10000;

    public function load(ObjectManager $manager)
    {
        $item = new Product();
        $item->setSku(sprintf("%05d",1));
        $item->setName(ProductName::get());
        $item->setCategory(Category::BOOTS);
        $item->setPrice(rand(self::MIN_COST, self::MAX_COST) * 100);

        $item = new Product();
        $item->setSku(sprintf("%05d",2));
        $item->setName(ProductName::get());
        $item->setCategory(Category::SANDALS);
        $item->setPrice(rand(self::MIN_COST, self::MAX_COST) * 100);

        $item = new Product();
        $item->setSku(sprintf("%05d",3));
        $item->setName(ProductName::get());
        $item->setCategory(Category::SNEAKERS);
        $item->setPrice(rand(self::MIN_COST, self::MAX_COST) * 100);

        $manager->persist($item);

        for ($i=3; $i<$_ENV['DATABASE_PRODUCT_COUNT'] - 3; $i++) {
            $item = new Product();
            $item->setSku(sprintf("%05d",$i + 1));
            $item->setName(ProductName::get());
            $item->setCategory(Category::getRand());
            $item->setPrice(rand(self::MIN_COST, self::MAX_COST) * 100);

            $manager->persist($item);
        }

        $manager->flush();
    }
}