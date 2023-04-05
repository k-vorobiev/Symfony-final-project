<?php

namespace App\ServiceInterface;

interface CompareToolInterface
{
    public function getCompareList();
    public function addCompareProduct();
    public function removeCompareProduct();
    public function count();
}
