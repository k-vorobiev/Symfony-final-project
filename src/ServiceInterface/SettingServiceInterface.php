<?php

namespace App\ServiceInterface;

interface SettingServiceInterface
{
    public function get($name, $value = null);
}