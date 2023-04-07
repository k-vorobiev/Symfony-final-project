<?php

namespace App\DataFixtures;

use App\Entity\Banner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BannerFixtures extends BaseFixtures
{
    protected static $bannerImage = array(
        'images/content/home/slider.png',
        'images/content/sale/product.png',
    );

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Banner::class, 6, function (Banner $banner) use ($manager) {
            $banner->setTitle($this->faker->title)
                ->setImageUrl($this->faker->randomElement(self::$bannerImage))
            ;

            if ($this->faker->boolean()) {
                $banner->setDescription($this->faker->realText());
            }
        });
    }
}
