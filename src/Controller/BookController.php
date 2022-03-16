<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/creer-livre')]
    public function new(EntityManagerInterface $manager): Response
    {
        $book = new Book();
        $book->setTitle('Livre de test');
        $book->setPrice(12.2);
        $book->setDescription('Description de mon livre');

        $manager->persist($book);

        $manager->flush();

        return new Response('Le livre ' . $book->getId() . ' à bien été créé');
    }

    #[Route('/livres')]
    public function list(BookRepository $repository): Response
    {
        $books = $repository->findAll();
        $html = '';

        foreach ($books as $book) {
            $html .= "<p>{$book->getTitle()}</p>";
        }

        return new Response($html);
    }
}
