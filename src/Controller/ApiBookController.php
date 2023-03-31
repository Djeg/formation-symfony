<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlleur d'api pour les livres
 */
class ApiBookController extends AbstractController
{
    /**
     * Liste toute les livres
     */
    #[Route('/api/books', name: 'app_api_book_list', methods: ['GET'])]
    public function list(BookRepository $repository, Request $request): Response
    {
        // Je créé mon formulaire de recherche
        $form = $this->createForm(BookSearchType::class);

        // Je remplie les données du formulaire
        $form->handleRequest($request);

        // Je récupére les critères de recherche
        $criteria = $form->getData();

        // Je lance la recherche en utilisant le repository
        $books = $repository->findAllByCriteria($criteria);

        return $this->json($books);
    }

    /**
     * Affiche une seul livre
     */
    #[Route('/api/books/{id}', name: 'app_api_book_show', methods: ['GET'])]
    public function show(Book $book): Response
    {
        return $this->json($book);
    }

    /**
     * Créer une nouvelle livre
     */
    #[Route('/api/books', name: 'app_api_book_create', methods: ['POST'])]
    public function create(Request $request, BookRepository $repository): Response
    {
        // Je créé le formulaire
        $form = $this->createForm(ApiBookType::class);

        // Je remplie le formulaire
        $form->handleRequest($request);

        // Je vérifie si le formulaire est envoyé et valide
        if (!$form->isSubmitted() || !$form->isValid()) {
            // On retourne les erreurs du formulaire ave le code
            // http 400, utilisé pour les erreurs du client
            return $this->json($form->getErrors(true, true), 400);
        }

        // J'enregistre mon auteur
        $repository->save(
            $form
                ->getData()
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime()),
            true
        );

        // Je retourne la livre en json
        return $this->json($form->getData(), 201);
    }

    /**
     * Edite une livre
     */
    #[Route('/api/books/{id}', name: 'app_api_book_edit', methods: ['PATCH'])]
    public function edit(Book $book, BookRepository $repository, Request $request): Response
    {
        // Création du formulaire
        $form = $this->createForm(ApiBookType::class, $book, [
            'method' => 'PATCH',
        ]);

        // Remplissage du formulaire
        $form->handleRequest($request);

        // Test de la validité du formulaire
        if (!$form->isSubmitted() || !$form->isValid()) {
            // Affichage des erreurs en json
            return $this->json($form->getErrors(true, true), 400);
        }

        // Enregistrement de la maison d"édition
        $repository->save($book->setUpdatedAt(new DateTime()), true);

        // On affiche la livre :)
        return $this->json($book);
    }

    /**
     * Suppression d'une livre
     */
    #[Route('/api/books/{id}', name: 'app_api_book_remove', methods: ['DELETE'])]
    public function remove(Book $book, BookRepository $repository): Response
    {
        // Suppression de la livres
        $repository->remove($book, true);

        // On retourne la livre
        return $this->json($book);
    }
}
