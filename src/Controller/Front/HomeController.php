<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_front_home_home')]
    public function home(
        BookRepository $bookRepository,
        AuthorRepository $authorRepository,
        CategoryRepository $categoryRepository,
    ): Response {
        $books = $bookRepository->findTenLast();
        $authors = $authorRepository->findFiveLast();
        $categories = $categoryRepository->findTenLast();

        return $this->render('front/home/home.html.twig', [
            'books' => $books,
            'authors' => $authors,
            'categories' => $categories,
        ]);
    }
}
