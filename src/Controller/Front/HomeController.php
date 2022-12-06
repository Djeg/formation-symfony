<?php

namespace App\Controller\Front;

use App\Repository\RealPropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlleur qui s'occupe et gére la page d'accueil ainsi que la page
 * de recherche :)
 */
class HomeController extends AbstractController
{
    /**
     * Affiche la page d'accueil
     */
    #[Route('/', name: 'app_front_home_home')]
    public function home(RealPropertyRepository $repository): Response
    {
        // récupération des 10 derniers biens immobilier
        $properties = $repository->findBy(
            [],
            ['createdAt' => 'DESC'],
            10,
        );

        // On affiche la page d'accueil
        return $this->render('front/home/home.html.twig', [
            'properties' => $properties,
        ]);
    }
}
