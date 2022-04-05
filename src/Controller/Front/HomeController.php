<?php

declare(strict_types=1);

namespace App\Controller\Front;

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
     * page d'accueil du site
     */
    #[Route('/', name: 'app_front_home_home')]
    public function home(): Response
    {
        return $this->render('front/home/home.html.twig');
    }
}
