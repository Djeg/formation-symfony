<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\DTO\BookSearch;
use App\Entity\Book;
use App\Form\Front\SearchBookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/livres/{id}', name: 'app_front_book_show')]
    public function show(Book $book): Response
    {
        return $this->render('front/book/show.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route('/rechercher', name: 'app_front_book_search')]
    public function search(Request $request, BookRepository $repository): Response
    {
        $form = $this->createForm(SearchBookType::class, new BookSearch());

        $form->handleRequest($request);

        $books = $repository->findBySearch($form->getData());

        return $this->render('front/book/search.html.twig', [
            'books' => $books,
            'formView' => $form->createView(),
        ]);
    }
}
