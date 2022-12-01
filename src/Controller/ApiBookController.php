<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\ApiBookType;
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
}
