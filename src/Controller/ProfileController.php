<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/personal', name: 'app_account')]
    public function account(): Response
    {
        return $this->render('pages/profile/account.html.twig');
    }

    #[Route('/personal/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('pages/profile/profile.html.twig');
    }

    #[Route('/personal/orders', name: 'app_profile_orders')]
    public function orders(): Response
    {
        return $this->render('pages/profile/orders.html.twig');
    }

    #[Route('/personal/view-history', name: 'app_profile_viewhistory')]
    public function viewHistory(): Response
    {
        return $this->render('pages/profile/view_history.html.twig');
    }
}
