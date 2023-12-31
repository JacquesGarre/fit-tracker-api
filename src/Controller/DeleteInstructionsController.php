<?php

namespace FitTrackerApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteInstructionsController extends AbstractController
{
    #[Route('/delete-my-account', name: 'app_delete_instructions')]
    public function index(): Response
    {
        return $this->render('delete_instructions/index.html.twig', [
            'controller_name' => 'DeleteInstructionsController',
        ]);
    }
}
