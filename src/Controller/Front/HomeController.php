<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
