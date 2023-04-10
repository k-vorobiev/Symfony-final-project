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

    public function getMin($value)
    {
        $min = PHP_INT_MAX;
        $prices = $value->toArray();

        /** @var Price $price */
        foreach ($prices as $price) {
            if ($min > $price->getValue()) {
                $min = $price->getValue();
            }
        }

        return $min;
    }

    public function getMinDiscont($value)
    {
        $min = PHP_INT_MAX;
        $prices = $value->toArray();

        /** @var Price $price */
        foreach ( $prices as $price) {
            $currentDiscontPrice = $price->getDiscontValue();
            if (isset($currentDiscontPrice) && $min > $currentDiscontPrice) {
                $min = $currentDiscontPrice;
            }
        }

        return $min;
    }
}
