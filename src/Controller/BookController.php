<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/livres/nouveau', name: 'app_book_create')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        if ($request->isMethod('GET')) {
            return $this->render('book/create.html.twig');
        }

        $book = new Book();
        $title = $request->request->get('title');
        $price = (float)$request->request->get('price');
        $description = $request->request->get('description');

        $book->setTitle($title);
        $book->setPrice($price);
        $book->setDescription($description);

        $manager->persist($book);

        $manager->flush();

        return $this->redirectToRoute('app_book_list');
    }

    #[Route('/livres', name: 'app_book_list')]
    public function list(BookRepository $repository): Response
    {
        $books = $repository->findAll();

        return $this->render('book/list.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/livres/{id}/modifier', name: 'app_book_update')]
    public function update(Request $request, EntityManagerInterface $manager, BookRepository $repository, int $id): Response
    {
        // Récupération d'un livre par son id
        $book = $repository->find($id);

        // On test si le livre éxiste
        if (!$book) {
            // retour d'une réponse 404
            return new Response("Le livre n'éxiste pas", 404);
        }

        if ($request->isMethod('GET')) {
            return $this->render('book/update.html.twig', ['book' => $book]);
        }

        $book->setTitle($request->request->get('title'));
        $book->setPrice((float)$request->request->get('price'));
        $book->setDescription($request->request->get('description'));

        $manager->persist($book);
        $manager->flush();

        return $this->redirectToRoute('app_book_list');
    }

    #[Route('/livres/{id}/supprimer', name: 'app_book_remove')]
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

        return $this->redirectToRoute('app_book_list');
    }
}
