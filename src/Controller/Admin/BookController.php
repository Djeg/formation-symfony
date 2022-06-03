<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    // Attacher une Route (OK)
    #[Route('/admin/livres/nouveau', name: 'app_admin_book_create')]
    public function create(Request $request, BookRepository $repository): Response
    {
        // Tester si le formulaire à était envoyé (OK)
        if ($request->isMethod('POST')) {
            // Récupérer les infos envoyé par l'utilisateur en utilisant la Request (OK)
            $title = $request->request->get('title');
            $price = $request->request->get('price');
            $description = $request->request->get('description');
            $imageUrl = $request->request->get('imageUrl');

            // Création du livre ! (OK)
            $book = new Book();
            $book->setTitle($title);
            $book->setPrice((float)$price);
            $book->setDescription($description);
            $book->setImageUrl($imageUrl);

            // Insérer/Enregistrer le nouveau livre dans la base de données (OK)
            $repository->add($book, true);

            // Rediriger vers la liste des livres (OK)
            return $this->redirectToRoute('app_admin_book_list');
        }

        // Afficher la page html contenant le formulaire de création d'un livre (OK)
        return $this->render('admin/book/create.html.twig');
    }

    // Attacher une route
    #[Route('/admin/livres', name: 'app_admin_book_list')]
    public function list(BookRepository $repository): Response
    {
        // Récupérer les livres depuis la base de données
        $books = $repository->findAll();

        // Afficher la page html de la liste des livres
        return $this->render('admin/book/list.html.twig', [
            'books' => $books,
        ]);
    }

    // Attacher une route (OK)
    #[Route('/admin/livres/{id}', name: 'app_admin_book_update')]
    public function update(int $id, BookRepository $repository, Request $request): Response
    {
        // Récupérer le livre que l'on veut modifier (OK)
        $book = $repository->find($id);

        // Tester si le formulaire a était envoyé (OK)
        if ($request->isMethod('POST')) {
            // Récupérer les infos envoyé par l'utilisateur en utilisant la Request (OK)
            $title = $request->request->get('title');
            $price = $request->request->get('price');
            $description = $request->request->get('description');
            $imageUrl = $request->request->get('imageUrl');

            // Méttre à jour les information du livre avec les infos récupéré (OK)
            $book->setTitle($title);
            $book->setPrice((float)$price);
            $book->setDescription($description);
            $book->setImageUrl($imageUrl);

            // Insérer/Enregistrer le nouveau livre dans la base de données (OK)
            $repository->add($book, true);

            // Rediriger vers la liste des livres (OK)
            return $this->redirectToRoute('app_admin_book_list');
        }

        // Afficher le formulaire d'édition d'un livre
        return $this->render('admin/book/update.html.twig', [
            'book' => $book,
        ]);
    }

    // Attacher une route
    #[Route('/admin/livres/{id}/supprimer', name: 'app_admin_book_remove')]
    public function remove(int $id, BookRepository $repository): Response
    {
        // Récupérer le livre que l'on veut supprimer
        $book = $repository->find($id);

        // Supprimer de la base de données
        $repository->remove($book, true);

        // Redirige vers la liste des livres
        return $this->redirectToRoute('app_admin_book_list');
    }
}
