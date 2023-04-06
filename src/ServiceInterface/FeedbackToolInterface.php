<?php

namespace App\ServiceInterface;

interface FeedbackToolInterface
{
    public function getProductFeedback();
    public function getProductFeedbackCount();
    public function addProductFeedback();
}