<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\MinPriceExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MinDiscontPriceExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('minPriceDiscont', [MinPriceExtensionRuntime::class, 'getMinDiscont']),
        ];
    }
}
