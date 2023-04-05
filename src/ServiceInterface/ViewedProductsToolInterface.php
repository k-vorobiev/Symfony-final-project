<?php

namespace App\ServiceInterface;

interface ViewedProductsToolInterface
{
    public function getViewedProduct();
    public function getViewedProductCount();
    public function addToViewedProduct();
    public function removeFromViewedProduct();
    public function isViewedProduct();
}
