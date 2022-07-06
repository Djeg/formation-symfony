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

    #[Route('/calculatrice/additionner/{x}/{y}', name: 'app_calculatrice_additionner')]
    public function additionner(int $x, int $y): Response
    {
        // calculer la total
        $total = $x + $y;

        // afficher la page de l'addition
        return $this->render('calculatrice/additionner.html.twig', [
            'x' => $x,
            'y' => $y,
            'total' => $total,
        ]);
    }
}
