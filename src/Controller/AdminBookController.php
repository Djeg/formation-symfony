<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller permettant de gérer les livres de notre application. Nous
 * retrouvons 4 routes, la création d'un livre, la mise à jour, la suppression
 * et la liste des livres.
 */
class AdminBookController extends AbstractController
{
    /**
     * Méthode permettant de créer un nouveau livre
     */
    #[Route('/admin/livres/nouveau', name: 'app_admin_book_create')]
    public function create(Request $request, BookRepository $repository): Response
    {
        // Je créer le formulaire
        $form = $this->createForm(BookType::class);

        // Je remplie le formulaire avec les données saisie par l'utilisateur
        $form->handleRequest($request);

        // Je test si le formulaire est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Je récupére le livre du formulaire
            $book = $form
                ->getData()
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime());

            // Enregistrer le livre dans le base de données
            $repository->save($book, true);

            // Je redirige vers la liste des livres
            return $this->redirectToRoute('app_admin_book_list');
        }

        // J'affiche la page de création d'un livre
        return $this->render('admin_book/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Liste tout les livres de l'application
     */
    #[Route('/admin/livres', name: 'app_admin_book_list')]
    public function list(BookRepository $repository): Response
    {
        // Je récupére tout les livres de ma base de données
        $books = $repository->findAll();

        // J'affiche la liste des livres
        return $this->render('admin_book/list.html.twig', [
            // On envoie à twig, tout nos livres
            'books' => $books,
        ]);
    }

    /**
     * Modifie un livre de la base de données
     */
    #[Route('/admin/livres/{id}', name: 'app_admin_book_update')]
    public function update(Book $book, Request $request, BookRepository $repository): Response
    {
        // Je créé le formulaire avec le livre
        $form = $this->createForm(BookType::class, $book);

        // Je remplie le formulaire avec les données saisie par l'utilisateur
        $form->handleRequest($request);

        // Je test si le formulaire est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // J'enregistre le livre dans la base de données
            $repository->save($book->setUpdatedAt(new DateTime()), true);

            // Je redirige vers la liste des livres
            return $this->redirectToRoute('app_admin_book_list');
        }

        // J'affiche la page de mise à jour d'un livre
        return $this->render('admin_book/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprime un livre de la base de données
     */
    #[Route('/admin/livres/{id}/supprimer', name: 'app_admin_book_remove')]
    public function remove(Book $book, BookRepository $repository): Response
    {
        // Je supprime le livre dans la base de données
        $repository->remove($book, true);

        // Je redirige vers la liste des livres
        return $this->redirectToRoute('app_admin_book_list');
    }
}
