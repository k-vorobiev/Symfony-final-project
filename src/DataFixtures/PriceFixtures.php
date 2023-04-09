<?php

namespace App\DataFixtures;

use App\Entity\Price;
use App\Entity\Product;
use App\Entity\Seller;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PriceFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Price::class, 40, function (Price $price) use ($manager) {
            $price->setValue($this->faker->randomDigit);

            if ($this->faker->boolean(30)) {
                if ($price->getValue() > 300) {
                    $price->setDiscontValue($price->getValue() - 250);
                }
            }

            $price->setSeller($this->getRandomReference(Seller::class));
            $price->setProduct($this->getRandomReference(Product::class));
        });
    }

    public function getDependencies()
    {
        return [
            SellerFixtures::class,
            ProductFixtures::class,
        ];
    }
}
