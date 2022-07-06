<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatriceController extends AbstractController
{
    #[Route('/calculatrice', name: 'app_calculatrice')]
    public function index(): Response
    {
        return $this->render('calculatrice/index.html.twig', [
            'controller_name' => 'CalculatriceController',
        ]);
    }
}
