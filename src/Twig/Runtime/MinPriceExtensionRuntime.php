<?php

namespace App\Twig\Runtime;

use App\Entity\Price;
use Twig\Extension\RuntimeExtensionInterface;

class MinPriceExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
        // Inject dependencies if needed
    }

    public function getMiddlePrice($value)
    {
        $all = [];
        $prices = $value->toArray();

        foreach ($prices as $price) {
            $all[] = $price->getValue();
        }
        sort($all);
        $count = count($all) - 1;

        return $all[$count];
    }
}
