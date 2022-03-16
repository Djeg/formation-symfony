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
        $manager->remove($book);

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

    #[Route('/livres/{id}')]
    public function one(BookRepository $repository, int $id): Response
    {
        // Récupération d'un livre par son id
        $book = $repository->find($id);

        // On test si le livre éxiste
        if (!$book) {
            // retour d'une réponse 404
            return new Response("Le livre n'éxiste pas", 404);
        }

        return new Response($book->getTitle());
    }

    #[Route('/livres/{id}/supprimer')]
    public function remove(
        BookRepository $repository,
        EntityManagerInterface $manager,
        int $id,
    ): Response {
        // Récupération d'un livre
        $book = $repository->find($id);

        // On test si le livre éxiste
        if (!$book) {
            // retour d'une réponse 404
            return new Response("Le livre n'éxiste pas", 404);
        }

        $manager->remove($book);

        $manager->flush();

        return new Response("Le livre {$id} à bien été supprimé");
    }
}
