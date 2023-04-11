<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompareController extends AbstractController
{
    #[Route('/compare', name: 'app_compare')]
    public function index(): Response
    {
        return $this->render('static/compare.html.twig');
    }
}
