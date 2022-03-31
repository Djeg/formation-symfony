<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/api/books', name: 'app_api_book_list', methods: ['GET'])]
    public function list(BookRepository $repository): Response
    {
        $books = $repository->findAll();

        return $this->json($books);
    }
}
