<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\ApiAuthorType;
use App\Form\AuthorSearchType;
use App\Repository\AuthorRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlleur d'api pour les auteurs
 */
class ApiAuthorController extends AbstractController
{
    /**
     * Liste tout les auteurs
     */
    #[Route('/api/authors', name: 'app_api_author_list', methods: ['GET'])]
    public function list(AuthorRepository $repository, Request $request): Response
    {
        // Je créé mon formulaire de recherche
        $form = $this->createForm(AuthorSearchType::class);

        // Je remplie les données du formulaire
        $form->handleRequest($request);

        // Je récupére les critères de recherche
        $criteria = $form->getData();

        // Je lance la recherche en utilisant le repository
        $authors = $repository->findAllByCriteria($criteria);

        return $this->json($authors);
    }

    /**
     * Affiche un seul auteur
     */
    #[Route('/api/authors/{id}', name: 'app_api_author_show', methods: ['GET'])]
    public function show(Author $author): Response
    {
        return $this->json($author);
    }

    /**
     * Créer un nouvel auteur
     */
    #[Route('/api/authors', name: 'app_api_author_create', methods: ['POST'])]
    public function create(Request $request, AuthorRepository $repository): Response
    {
        // Je créé le formulaire
        $form = $this->createForm(ApiAuthorType::class);

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

        // Je retourne l'auteur en json
        return $this->json($form->getData());
    }
}
