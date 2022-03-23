<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/', name: 'app_book_home')]
    public function home(BookRepository $repository): Response
    {
        $books = $repository->findFiveLast();

        return $this->render('book/home.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/les-moins-chers', name: 'app_book_cheap')]
    public function cheap(BookRepository $repository): Response
    {
        $books = $repository->findFiveLastCheaper();

        return $this->render('book/cheap.html.twig', [
            'books' => $books,
        ]);
    }
}
