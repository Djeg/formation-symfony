<?php

namespace App\Controller;

use DateTime;
use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Ce controller contient le code de la page d'accueil
 */
class HomeController extends AbstractController
{
    /**
     * Affiche la page d'accueil
     */
    #[Route('/', name: 'app_home_index', methods: ['GET'])]
    public function index(BookRepository $repository, Request $request): Response
    {
        // Afficher le template twig "home/index.html.twig" :
        return $this->render('home/index.html.twig');
    }
}
