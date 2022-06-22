<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    /**
     * Affiche la page d'accueil
     */
    #[Route('/', name: 'app_pizza_home')]
    public function home(PizzaRepository $repository): Response
    {
        // Récupération de toutes les pizzas
        $pizzas = $repository->findAll();

        // Affichage de la page
        return $this->render('pizza/home.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }
}
