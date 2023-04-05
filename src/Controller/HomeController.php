<?php

namespace App\Controller;

use App\Form\BookAdSearchType;
use App\Repository\BookAdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home_home')]
    public function home(BookAdRepository $repository): Response
    {
        // Je récupére les 25 derniers livres
        $books = $repository->findLatest();

        return $this->render('home/home.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/rechercher', name: 'app_home_search')]
    public function search(BookAdRepository $repository, Request $request): Response
    {
        // Jé créer le formulaire de recherche
        $form = $this->createForm(BookAdSearchType::class);

        // Je remplie le formulaire
        $form->handleRequest($request);

        // Je lance la recherche
        $books = $repository->findAllByCriteria($form->getData());

        // J'affiche la page de recherche
        return $this->render('home/search.html.twig', [
            'books' => $books,
            'form' => $form->createView(),
        ]);
    }
}
