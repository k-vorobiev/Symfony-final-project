<?php

namespace App\DataFixtures;

use App\Entity\Vendor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VendorFixtures extends BaseFixtures
{
    protected static $vendorImages = array(
        'images/content/home/bigGoods.png',
        'images/content/home/videoca.png',
    );

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Vendor::class, 10, function (Vendor $vendor) use ($manager) {
            $vendor->setName($this->faker->company)
                ->setDescription($this->faker->realText(500))
                ->setImageUrl($this->faker->randomElement(self::$vendorImages))
                ->setPhone($this->faker->phoneNumber)
                ->setEmail($this->faker->email)
                ->setAddress($this->faker->address)
            ;
        });
    }
}
