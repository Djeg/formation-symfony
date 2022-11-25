<?php

namespace App\Controller;

use App\Form\AdSearchType;
use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * Affiche la page de recheche des annonces
     */
    #[Route('/rechercher', name: 'app_home_search', methods: ['GET'])]
    public function search(Request $request, AdRepository $repository): Response
    {
        // Création du formulaire de recherche
        $form = $this->createForm(AdSearchType::class);

        // Remplir le formulaire avec la requête
        $form->handleRequest($request);

        // Récupérer les critéres de recherche et lancer la recherche
        $ads = $repository->findBySearchCriteria($form->getData());

        // Afficher la page twig
        return $this->render('home/search.html.twig', [
            'ads' => $ads,
            'form' => $form->createView(),
        ]);
    }
}
