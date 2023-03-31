<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlleur d'api pour les livres
 */
class ApiBookController extends AbstractController
{
    /**
     * Liste tout les livres
     */
    #[Route('/api/books', name: 'app_api_book_list')]
    public function list(BookRepository $repository): Response
    {
        return $this->json($repository->findAll());
    }

    /**
     * Affiche un seul livre
     */
    #[Route('/api/books/{id}', name: 'app_api_book_show')]
    public function show(Book $book): Response
    {
        return $this->json($book);
    }
}
