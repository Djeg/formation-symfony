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

    #[Route('/additionner')]
    public function additionner(): Response
    {
        return $this->render('calculatrice/additionner.html.twig');
    }

    #[Route('/soustraire')]
    public function soustraire(): Response
    {
        return $this->render('calculatrice/soustraire.html.twig');
    }

    #[Route('/diviser')]
    public function diviser(): Response
    {
        return $this->render('calculatrice/diviser.html.twig');
    }

    #[Route('/multiplier')]
    public function multiplier(): Response
    {
        return $this->render('calculatrice/multiplier.html.twig');
    }
}
