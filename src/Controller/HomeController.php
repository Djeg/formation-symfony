<?php

namespace App\Controller;

use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller de la page d'acueil
 */
class HomeController extends AbstractController
{
    /**
     * Affice la page d'accueil
     */
    #[Route('/', name: 'app_home_home', methods: ['GET'])]
    public function home(AdRepository $repository): Response
    {
        // Récupérer les 10 dernières annonces
        $ads = $repository->findBy([], ['updatedAt' => 'DESC'], 10);

        // On affiche la page (le vue)
        return $this->render('home/home.html.twig', [
            'ads' => $ads,
        ]);
    }
}
