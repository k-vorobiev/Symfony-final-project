<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Seller;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends BaseFixtures implements DependentFixtureInterface
{
    protected static $productImages = array(
        'images/content/sale/product.png',
    );

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Product::class, 30, function (Product $product) use ($manager) {
           $product->setTitle($this->faker->title)
               ->setShortDescription($this->faker->realText(100))
               ->setDescription($this->faker->realText(1000))
               ->setImageUrl($this->faker->randomElement(self::$productImages))
               ->setCategory($this->getRandomReference(Category::class))
           ;

           if ($this->faker->boolean(30)) {
               $product->setIsActive(0);
           }

           /** @var Seller $seller */
           $sellers = [];

           for ($i = 0; $i < $this->faker->numberBetween(3, 5); $i++) {
              $sellers[] = $this->getRandomReference(Seller::class);
           }

           foreach ($sellers as $seller) {
               $product->addSeller($seller);
           }
        });
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            SellerFixtures::class,
        ];
    }

}
