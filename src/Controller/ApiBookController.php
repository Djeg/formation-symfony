<?php

namespace App\Controller;

use App\DTO\BookSearchCriteria;
use App\Entity\Book;
use App\Form\ApiBookType;
use App\Form\SearchBookType;
use App\Repository\BookRepository;
use DateTime;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

/**
 * Ce controller contient toutes les routes de l'API pour gérer les livres
 */
class ApiBookController extends AbstractController
{
    /**
     * Créer un nouveau livre sur notre api
     */
    #[OA\Tag(name: 'Books')]
    #[OA\RequestBody(content: new Model(type: Book::class, groups: ['api_create']))]
    #[OA\Response(
        response: 201,
        description: 'Créé un nouveau livre',
        content: new Model(type: Book::class, groups: ['default'])
    )]
    #[Route('/api/books', name: 'app_apiBook_create', methods: ['POST'])]
    public function create(Request $request, BookRepository $repository): Response
    {
        // Création du formulaire du livre
        $form = $this->createForm(ApiBookType::class);

        // On remplie le formulaire
        $form->handleRequest($request);

        // on test la validité du formulaire
        if (!$form->isSubmitted() || !$form->isValid()) {
            // On retourne les erreur du formulaire avec le code http 400
            return $this->json($form->getErrors(true), 400);
        }

        // On enregistre le livre
        $repository->save($form->getData(), true);

        // On retourne le livre avec le code HTTP 201
        return $this->json($form->getData(), 201);
    }

    /**
     * Liste et recherche des livres de l'api
     */
    #[OA\Tag(name: 'Books')]
    #[OA\Parameter(
        in: 'query',
        name: 'bookCriterias',
        schema: new OA\Schema(ref: new Model(type: BookSearchCriteria::class), required: [])
    )]
    #[OA\Response(
        response: 200,
        description: 'La liste des livres',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Book::class, groups: ['default']))
        )
    )]
    #[Route('/api/books', name: 'app_apiBook_list', methods: ['GET'])]
    public function list(Request $request, BookRepository $repository): Response
    {
        // Création du formulaire de recherche
        $form = $this->createForm(SearchBookType::class);

        // On remplie le formulaire
        $form->handleRequest($request);

        // On lance la recherche
        $books = $repository->findAllBySearchCriteria($form->getData());

        // On retourne la liste des livres
        return $this->json($books);
    }

    /**
     * Met à jour un livre
     */
    #[OA\Tag(name: 'Books')]
    #[OA\RequestBody(content: new Model(type: Book::class, groups: ['api_create']))]
    #[OA\Response(
        response: 201,
        description: 'Met à jour un livre',
        content: new Model(type: Book::class, groups: ['default'])
    )]
    #[Route('/api/books/{id}', name: 'app_apiBook_update', methods: ['PATCH'])]
    public function update(Book $book, BookRepository $repository, Request $request): Response
    {
        // Création du formulaire du livre
        $form = $this->createForm(ApiBookType::class, $book, [
            'method' => 'PATCH',
        ]);

        // On remplie le formulaire
        $form->handleRequest($request);

        // on test la validité du formulaire
        if (!$form->isSubmitted() || !$form->isValid()) {
            // On retourne les erreur du formulaire avec le code http 400
            return $this->json($form->getErrors(true), 400);
        }

        // On enregistre le livre
        $repository->save($form->getData(), true);

        // On retourne le livre avec le code HTTP 200
        return $this->json($form->getData());
    }

    /**
     * On supprime un livre
     */
    #[OA\Tag(name: 'Books')]
    #[OA\Response(
        response: 200,
        description: 'Supprime un livre',
        content: new Model(type: Book::class, groups: ['default'])
    )]
    #[Route('/api/books/{id}', name: 'app_apiBook_remove', methods: ['DELETE'])]
    public function remove(Book $book, BookRepository $repository): Response
    {
        $repository->remove($book, true);

        return $this->json($book);
    }

    /**
     * On récupére un livre
     */
    #[OA\Tag(name: 'Books')]
    #[OA\Response(
        response: 200,
        description: 'Récupération d\'un livre',
        content: new Model(type: Book::class, groups: ['default'])
    )]
    #[Route('/api/books/{id}', name: 'app_apiBook_get', methods: ['GET'])]
    public function get(Book $book): Response
    {
        return $this->json($book);
    }
}
