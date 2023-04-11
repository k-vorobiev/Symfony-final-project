<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\MinPriceExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MinPriceExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('middlePrice', [MinPriceExtensionRuntime::class, 'getMiddlePrice']),
        ];
    }
}
