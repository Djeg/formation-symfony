<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\PublishingHouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlleur contenant la page d'accueil et aussi la page de recherche
 * de livres
 */
class HomeController extends AbstractController
{
    /**
     * Page d'accueil de l'application
     */
    #[Route('/', name: 'app_home_home')]
    public function home(
        BookRepository $bookRepository,
        AuthorRepository $authorRepository,
        PublishingHouseRepository $pubHouseRepository,
    ): Response {
        // Je récupére les 25 derniers livres
        $books = $bookRepository->findLatest();
        $authors = $authorRepository->findLatest();
        $pubHouses = $pubHouseRepository->findLatest();

        // J'affiche la page d'accueil
        return $this->render('home/home.html.twig', [
            'books' => $books,
            'authors' => $authors,
            'pubHouses' => $pubHouses,
        ]);
    }
}
