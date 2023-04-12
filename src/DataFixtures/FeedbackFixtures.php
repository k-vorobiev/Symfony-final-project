<?php

namespace App\DataFixtures;

use App\Entity\Feedback;
use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FeedbackFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Feedback::class, 500, function (Feedback $feedback) use ($manager) {
            $feedback->setName($this->faker->name)
                ->setBody($this->faker->realText(400))
                ->setEmail($this->faker->email)
                ->setProduct($this->getRandomReference(Product::class))
            ;
        });
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}
