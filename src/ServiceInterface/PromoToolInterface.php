<?php

namespace App\ServiceInterface;

interface PromoToolInterface
{
    public function getPromoList();
    public function getPriorityPromo();
    public function getPromoPrice();
}
