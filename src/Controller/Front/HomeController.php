<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * voici le controlleur contenant la page d'accueil de
 * l'application PizzaShop
 */
class HomeController extends AbstractController
{
    /**
     * Voici la méthode de controlleur affichant la 
     * page d'accueil du site. Pour cette page 
     * d'accueil nous récupérons la liste des dernières
     * pizza.
     */
    #[Route('/', name: 'app_front_home_home')]
    public function home(PizzaRepository $repository): Response
    {
        $pizzas = $repository->findLatest();

        return $this->render('front/home/home.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }
}
