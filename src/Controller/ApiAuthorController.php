<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlleur d'api pour les auteurs
 */
class ApiAuthorController extends AbstractController
{
    /**
     * Liste tout les auteurs
     */
    #[Route('/api/authors', name: 'app_api_author_list')]
    public function list(AuthorRepository $repository): Response
    {
        return $this->json($repository->findAll());
    }

    /**
     * Affiche un seul auteur
     */
    #[Route('/api/authors/{id}', name: 'app_api_author_show')]
    public function show(Author $author): Response
    {
        return $this->json($author);
    }
}
