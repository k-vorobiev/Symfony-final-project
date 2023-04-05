<?php

namespace App\ServiceInterface;

interface CartToolInterface
{
    public function getCartList();
    public function getCartCount();
    public function addToCart();
    public function removeFromCart();
    public function editCartProductCount();
}
