<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HealthController extends AbstractController
{

    #[Route('/health', name: 'app_health')]
    public function index(): Response
    {
        return $this->json('App is running !');
    }
}
