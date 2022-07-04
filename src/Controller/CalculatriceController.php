<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/calculatrice')]
class CalculatriceController extends AbstractController
{
    #[Route('/accueil', name: 'app_calculatrice_index')]
    public function index(): Response
    {
        return $this->render('calculatrice/index.html.twig');
    }
}
