<?php

namespace App\Controller\Front;

use App\Form\SearchRealPropertyType;
use App\Repository\RealPropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * Recherche des biens immobilier à vendre
     */
    #[Route('/rechercher', name: 'app_front_home_search', methods: ['GET'])]
    public function search(Request $request, RealPropertyRepository $repository): Response
    {
        // Création du formulaire de recherche & remplissage        
        $form = $this->createForm(SearchRealPropertyType::class);
        $form->handleRequest($request);

        // Lancement de la recherche à la base de données
        $realProperties = $repository->findAllBySearchCriteria($form->getData());

        // Affichage de la page de recherche
        return $this->render('front/home/search.html.twig', [
            'form' => $form->createView(),
            'realProperties' => $realProperties,
        ]);
    }
}
