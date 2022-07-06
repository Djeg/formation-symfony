<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalculatriceController extends AbstractController
{
    #[Route('/calculatrice', name: 'app_calculatrice_index')]
    public function index(): Response
    {
        return $this->render('calculatrice/index.html.twig');
    }
}
