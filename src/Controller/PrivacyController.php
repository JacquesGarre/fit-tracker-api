<?php

namespace FitTrackerApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrivacyController extends AbstractController
{
    #[Route('/privacy', name: 'app_privacy')]
    public function index(): Response
    {
        return $this->render('privacy/index.html.twig', [
            'controller_name' => 'PrivacyController',
        ]);
    }
}
