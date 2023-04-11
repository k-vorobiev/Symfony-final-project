<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscountController extends AbstractController
{
    #[Route('/promo', name: 'app_discount')]
    public function index(): Response
    {
        return $this->render('static/discount.html.twig');
    }
}
