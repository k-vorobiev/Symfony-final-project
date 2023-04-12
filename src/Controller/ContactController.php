<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contacts', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('static/contact.html.twig');
    }

    #[Route('/about-us', name: 'app_aboutus')]
    public function aboutUs(): Response
    {
        return $this->render('static/about_us.html.twig');
    }
}
