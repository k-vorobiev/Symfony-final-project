<?php

namespace App\DataFixtures;

use App\Entity\Seller;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SellerFixtures extends BaseFixtures
{
    protected static $sellerImages = array(
        'images/content/home/bigGoods.png',
        'images/content/home/videoca.png',
    );

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Seller::class, 30, function (Seller $seller) use ($manager) {
            $seller->setName($this->faker->company)
                ->setDescription($this->faker->realText(500))
                ->setImageUrl($this->faker->randomElement(self::$sellerImages))
                ->setPhone($this->faker->phoneNumber)
                ->setEmail($this->faker->email)
                ->setAddress($this->faker->address)
            ;
        });
    }
}
