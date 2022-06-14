<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Form\AdminBookType;
use App\Repository\BookRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
class BookController extends AbstractController
{
    // Attacher une Route (OK)
    #[Route('/admin/livres/nouveau', name: 'app_admin_book_create')]
    public function create(Request $request, BookRepository $repository): Response
    {
        // Création du formulaire
        $form = $this->createForm(AdminBookType::class);

        // On remplie le formulaire avec les données envoyés par l'utilisateur
        $form->handleRequest($request);

        // Tester si le formulaire à était envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération du livre
            $book = $form->getData();

            // Insérer/Enregistrer le nouveau livre dans la base de données (OK)
            $repository->add($book, true);

            // Rediriger vers la liste des livres (OK)
            return $this->redirectToRoute('app_admin_book_list');
        }

        // Afficher la page html contenant le formulaire de création d'un livre (OK)
        return $this->render('admin/book/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Attacher une route
    #[Route('/admin/livres', name: 'app_admin_book_list')]
    public function list(BookRepository $repository): Response
    {
        // Récupérer les livres depuis la base de données
        $books = $repository->findAllByTitleDesc();

        // Afficher la page html de la liste des livres
        return $this->render('admin/book/list.html.twig', [
            'books' => $books,
        ]);
    }

    // Attacher une route (OK)
    #[Route('/admin/livres/{id}', name: 'app_admin_book_update')]
    public function update(Book $book, BookRepository $repository, Request $request): Response
    {
        // Création du formulaire
        $form = $this->createForm(AdminBookType::class, $book);

        // On remplie le formulaire avec les données envoyés par l'utilisateur
        $form->handleRequest($request);

        // Tester si le formulaire à était envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération du livre
            $book = $form->getData();

            // Insérer/Enregistrer le nouveau livre dans la base de données (OK)
            $repository->add($book, true);

            // Rediriger vers la liste des livres (OK)
            return $this->redirectToRoute('app_admin_book_list');
        }

        // Afficher la page html contenant le formulaire de création d'un livre (OK)
        return $this->render('admin/book/update.html.twig', [
            'form' => $form->createView(),
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
