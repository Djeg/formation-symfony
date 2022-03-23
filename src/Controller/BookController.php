<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/auteur/{id}/livres', name: 'app_book_lastForAuthor')]
    public function lastForAuthor(int $id, BookRepository $repository): Response
    {
        $books = $repository->findLastTenForAuthor($id);

        return $this->render('book/lastForAuthor.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/rechercher/{title}', name: 'app_book_titleSearch')]
    public function titleSearch(string $title, BookRepository $repository): Response
    {
        $books = $repository->findLastTenMatchingTitle($title);

        return $this->render('book/titleSearch.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/rechercher', name: 'app_book_search')]
    public function search(BookRepository $repository, Request $request): Response
    {
        $title = $request->query->get('titre');
        $limit = (int)$request->query->get('limite');
        $page = (int)$request->query->get('page');

        $books = $repository->findBySearch($title, $limit, $page);

        return $this->render('book/search.html.twig', [
            'books' => $books,
        ]);
    }
}
