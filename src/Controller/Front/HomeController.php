<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\DTO\SearchBookCriteria;
use App\Form\SearchBookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_front_home_home')]
    public function home(BookRepository $repository): Response
    {
        // Récupérer les livres
        $books = $repository->findAllOrderedByPrice();

        // Afficher la page d'accueil
        return $this->render('front/home/home.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/rechercher', name: 'app_front_home_search')]
    public function search(Request $request, BookRepository $repository): Response
    {
        // 1 Création des critères de recherche
        $criteria = new SearchBookCriteria();

        // 2 Création du formulaire
        $form = $this->createForm(SearchBookType::class, $criteria);

        // 3 - On remplie le formulaire avec ce que l'utilisateur a spécifié
        $form->handleRequest($request);

        // 4. Récupérer les livres correspondant à la recherchie
        $books = $repository->findByCriteria($criteria);

        // On affiche la page HTML
        return $this->render('front/home/search.html.twig', [
            'books' => $books,
            'form' => $form->createView(),
        ]);
    }
}
