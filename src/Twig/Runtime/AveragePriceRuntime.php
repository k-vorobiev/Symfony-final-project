<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class AveragePriceRuntime implements RuntimeExtensionInterface
{
    public function average($prices)
    {
        $value = $prices;

        if (!is_array($value)) return false;
        if (!count($value)) return 0;

        $avg = 0;

        foreach ($value as $num) $avg += $num->getValue();

        $avg /= count($value);

        return round($avg);
    }
}
