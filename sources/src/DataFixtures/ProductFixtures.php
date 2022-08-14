<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Service\Product\Category;
use App\Service\Product\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<$_ENV['DATABASE_PRODUCT_COUNT']; $i++) {
            $item = new Product();
            $item->setSku(sprintf("%05d",$i + 1));
            $item->setName(ProductName::get());
            $item->setCategory(Category::getRand());
            $item->setPrice(rand(10, 10000) * 100);

            $manager->persist($item);
        }

        $manager->flush();
    }
}