<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Entity\Book;
use App\Form\API\ApiBookType;
use App\Form\API\ApiSearchBookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/api/books', name: 'app_api_book_list', methods: ['GET'])]
    public function list(BookRepository $repository, Request $request): Response
    {
        /**
         * Création d'un formulaire de recherche pour les livres :
         * ApiSearchBookType
         */
        $form = $this->createForm(ApiSearchBookType::class);

        /**
         * On remplie le formulaire avec les filtres (query string)
         * préciser dans l'url
         */
        $form->handleRequest($request);

        /**
         * On récupére les données dans la base de données,
         * on envoie le DTO (Data Transfert Object : App\DTO\BookSearch) 
         * à notre BookRepository.
         * 
         * Graçe au données contenue à l'intérieur du DTO nous pouvons
         * rechercher des livres spécifique.
         */
        $books = $repository->findBySearch($form->getData());

        /**
         * On transforme notre tableaux de livres en tableau
         * JSON et nous retournons une réponse.
         */
        return $this->json($books);
    }

    #[Route('/api/books/{id}', name: 'app_api_book_one', methods: ['GET'])]
    public function one(Book $book): Response
    {
        return $this->json($book);
    }

    #[Route('/api/books', name: 'app_api_book_create', methods: ['POST'])]
    public function create(Request $request, BookRepository $repository): Response
    {
        /**
         * Création d'un formulaire ApiBookType à partir 
         * d'un Book vide (new Book()).
         * 
         * On spécifie aussi la méthode utilisé par le formulaire
         * dans les options.
         */
        $form = $this->createForm(ApiBookType::class, new Book(), [
            'method' => 'POST',
        ]);

        /**
         * On remplie le formulaire avec les données de la requête.
         * 
         * On remple le formulaire avec l'objet JSON qui a été
         * envoyé lors de la requête.
         */
        $form->handleRequest($request);

        /**
         * Si le formulaire n'as pas été envoyé ou si le formulaire
         * n'est pas valide
         */
        if (!$form->isSubmitted() || !$form->isValid()) {
            /**
             * Nous retournons les erreurs du formulaires sous forme d'object
             * JSON avec le code HTTP 400 Bad Request.
             * 
             * Ce code HTTP est utilisé pour signaler à l'utilisateur une
             * erreur durant le traitement des données envoyé.
             */
            return $this->json($form->getErrors(), 400);
        }

        /**
         * On enregistre le livre dans la base de donnée:
         */
        $repository->add($form->getData());

        /**
         * On retourne le livre tout juste inséré dans la base
         * de données en JSON
         */
        return $this->json($form->getData(), 201);
    }

    #[Route('/api/books/{id}', name: 'app_api_book_update', methods: ['PATCH'])]
    public function update(Book $book, Request $request, BookRepository $repository): Response
    {
        /**
         * Création d'un formulaire ApiBookType à partir 
         * du livre que symfony à résolu plus haut.
         * 
         * On spécifie aussi la méthode utilisé par le formulaire
         * dans les options.
         */
        $form = $this->createForm(ApiBookType::class, $book, [
            'method' => 'PATCH',
        ]);

        /**
         * On remplie le formulaire avec les données de la requête.
         * 
         * On remple le formulaire avec l'objet JSON qui a été
         * envoyé lors de la requête.
         */
        $form->handleRequest($request);

        /**
         * Si le formulaire n'as pas été envoyé ou si le formulaire
         * n'est pas valide
         */
        if (!$form->isSubmitted() || !$form->isValid()) {
            /**
             * Nous retournons les erreurs du formulaires sous forme d'object
             * JSON avec le code HTTP 400 Bad Request.
             * 
             * Ce code HTTP est utilisé pour signaler à l'utilisateur une
             * erreur durant le traitement des données envoyé.
             */
            return $this->json($form->getErrors(), 400);
        }

        /**
         * On enregistre le livre dans la base de donnée:
         */
        $repository->add($form->getData());

        /**
         * On retourne le livre tout juste mis à jour dans la base
         * de données en JSON
         */
        return $this->json($form->getData(), 200);
    }

    #[Route('/api/books/{id}', name: 'app_api_book_delete', methods: ['DELETE'])]
    public function delete(Book $book, BookRepository $repository): Response
    {
        /**
         * On suprimme le livre de la base de données
         */
        $repository->remove($book);

        /**
         * On retourne le livre tout juste supprimé avec le code
         * 200
         */
        return $this->json($book);
    }
}
