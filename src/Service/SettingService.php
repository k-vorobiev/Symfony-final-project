<?php

namespace App\Service;

use App\ServiceInterface\SettingServiceInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class SettingService implements SettingServiceInterface
{
    private ContainerBagInterface $params;

    public function __construct(ContainerBagInterface $params)
    {
        $this->params = $params;
    }

    public function get($name, $value = null)
    {
        if (!$value) {
            return $this->params->get($name);
        }

        return $value;
    }
}