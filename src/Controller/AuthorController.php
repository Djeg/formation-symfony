<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlleur concernant les auteurs de l'application sur la partie
 * publique de notre site internet
 */
class AuthorController extends AbstractController
{
    /**
     * Route permettant d'afficher la liste de tout les auteurs
     */
    #[Route('/auteurs', name: 'app_author_list')]
    public function list(AuthorRepository $repository): Response
    {
        // Je récupére tout les auteurs
        $authors = $repository->findAll();

        // J'affiche la page listant tout les auteurs
        return $this->render('author/list.html.twig', [
            'authors' => $authors,
        ]);
    }

    /**
     * Route permettant d'afficher le détail d'un auteur
     */
    #[Route('/auteurs/{id}', name: 'app_author_show')]
    public function show(Author $author): Response
    {
        // J'affiche la page de détail
        return $this->render('author/show.html.twig', [
            'author' => $author,
        ]);
    }
}
