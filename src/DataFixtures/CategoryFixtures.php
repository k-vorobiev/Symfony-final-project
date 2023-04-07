<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

class CategoryFixtures extends BaseFixtures
{
    protected static $categoryImage = array(
        'images/icons/departments/1.svg',
        'images/icons/departments/2.svg',
        'images/icons/departments/3.svg',
        'images/icons/departments/4.svg',
        'images/icons/departments/5.svg',
        'images/icons/departments/6.svg',
        'images/icons/departments/7.svg',
        'images/icons/departments/8.svg',
        'images/icons/departments/9.svg',
        'images/icons/departments/10.svg',
        'images/icons/departments/11.svg',
        'images/icons/departments/12.svg',
    );

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Category::class, 10, function (Category $category) use ($manager) {
            $category->setName($this->faker->realText(15))
                     ->setImageUrl($this->faker->randomElement(self::$categoryImage))
                     ->setSortIndex($this->faker->numberBetween(1, 10))
            ;

            if ($this->faker->boolean(20)) {
                $category->setIsActive(0);
            }
        });
    }
}
