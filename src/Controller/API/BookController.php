<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Form\API\ApiSearchBookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/api/books', name: 'app_api_book_list', methods: ['GET'])]
    public function list(BookRepository $repository, Request $request): Response
    {
        $form = $this->createForm(ApiSearchBookType::class);

        $form->handleRequest($request);

        $books = $repository->findBySearch($form->getData());

        return $this->json($books);
    }
}
