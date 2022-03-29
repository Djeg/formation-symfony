<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
