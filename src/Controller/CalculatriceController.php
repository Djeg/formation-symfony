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

    #[Route('/additionner/{x}/{y}')]
    public function additionner(int $x, int $y): Response
    {
        $total = $x + $y;

        return $this->render('calculatrice/additionner.html.twig', [
            'firstNumber' => $x,
            'secondNumber' => $y,
            'total' => $total,
        ]);
    }

    #[Route('/soustraire')]
    public function soustraire(): Response
    {
        return $this->render('calculatrice/soustraire.html.twig');
    }

    #[Route('/multiplier')]
    public function multiplier(): Response
    {
        return $this->render('calculatrice/multiplier.html.twig');
    }

    #[Route('/diviser')]
    public function diviser(): Response
    {
        return $this->render('calculatrice/diviser.html.twig');
    }
}
