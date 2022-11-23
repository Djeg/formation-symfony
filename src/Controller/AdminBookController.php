<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Ce controller contient toutes les pages de l'administration
 * des livres
 */
class AdminBookController extends AbstractController
{
    /**
     * Cette méthode affiche et créer un nouveau livre
     */
    #[Route('/admin/livres/nouveau', name: 'app_adminBook_create', methods: ['GET', 'POST'])]
    public function create(Request $request, BookRepository $repository): Response
    {
        // On créer le formulaire de livre
        $form = $this->createForm(BookType::class);

        // Remplir le formulaire
        $form->handleRequest($request);

        // On test si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupére le livre
            $book = $form->getData();

            $book
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime());

            // Enregistrement dans la base de données
            $repository->save($book, true);

            // Redirection vers la liste
            return $this->redirectToRoute('app_adminBook_list');
        }

        // Afficher la page de création d'un livre
        return $this->render('adminBook/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Liste les livres de l'application
     */
    #[Route('/admin/livres', name: 'app_adminBook_list', methods: ['GET'])]
    public function list(BookRepository $repository): Response
    {
        // Récupérer tout les livres
        $books = $repository->findAll();

        // Afficher une page pour les livres
        return $this->render('adminBook/list.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * Met à jour un livre
     */
    #[Route('/admin/livres/{id}', name: 'app_adminBook_update', methods: ['GET', 'POST'])]
    public function update(Book $book, Request $request, BookRepository $repository): Response
    {
        // Créer le formulaire
        $form = $this->createForm(BookType::class, $book, [
            'mode' => 'update',
        ]);

        // On le remplie avec les données de la requête
        $form->handleRequest($request);

        // On test si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupére le livre
            $book = $form->getData();

            // On met à jour la date de mise à jour
            $book->setUpdatedAt(new DateTime());

            // Enregistre le livre dans la base de données
            $repository->save($book, true);

            // Rediriger vers la liste
            return $this->redirectToRoute('app_adminBook_list');
        }

        // Afficher le formulaire
        return $this->render('adminBook/update.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprime un livre
     */
    #[Route('/admin/livres/{id}/supprimer', name: 'app_adminBook_remove', methods: ['GET'])]
    public function remove(Book $book, BookRepository $repository): Response
    {
        // Supprimer le livre de la table
        $repository->remove($book, true);

        // Redirection vers la liste
        return $this->redirectToRoute('app_adminBook_list');
    }
}
