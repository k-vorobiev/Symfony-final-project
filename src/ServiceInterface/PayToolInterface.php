<?php

namespace App\ServiceInterface;

interface PayToolInterface
{
    public function getOrderStatus();
    public function payOrder();
}
