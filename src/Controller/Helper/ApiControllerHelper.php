<?php

declare(strict_types=1);

namespace App\Controller\Helper;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Aide permettant de mettre en place facilement un controller d'api
 * avec les méthodes suivantes :
 * 
 * - createOrUpdate : Créer ou mettre à jour une entité
 * - list : Liste une entité
 * - remove : Supprime une entité
 * - get : Récupére un entité
 */
trait ApiControllerHelper
{
    /**
     * Créé ou met à jour une entité
     */
    public function apiInsert(
        string $formType,
        Request $request,
        $repository,
        $data = null,
    ): Response {
        // Création du formulaire
        $form = $this->createForm($formType, $data, [
            'method' => $request->getMethod(),
        ]);

        // On remplie le formulaire
        $form->handleRequest($request);

        // on test la validité du formulaire
        if (!$form->isSubmitted() || !$form->isValid()) {
            // On retourne les erreur du formulaire avec le code http 400
            return $this->json($form->getErrors(true), 400);
        }

        // On enregistre l'entité
        $repository->save($form->getData(), true);

        // On retourne l'entitté avec le code HTTP 200
        return $this->json($form->getData(), $request->isMethod(Request::METHOD_POST) ? 201 : 200, [], ['groups' => ['default']]);
    }

    /**
     * Liste des entités
     */
    public function apiList(
        string $formType,
        Request $request,
        $repository,
    ): Response {
        // Création du formulaire, et on le remplie
        $form = $this->createForm($formType);
        $form->handleRequest($request);

        // On lance la recherche
        $data = $repository->findAllBySearchCriteria($form->getData());

        // On retourne la réponse en json
        return $this->json($data, 200, [], ['groups' => ['default']]);
    }

    /**
     * Supprime une entité
     */
    public function apiRemove(
        $data,
        $repository,
    ): Response {
        $repository->remove($data, true);

        return $this->json($data, 200, [], ['groups' => ['default']]);
    }

    /**
     * Récupére une entité
     */
    public function apiGet($data): Response
    {
        return $this->json($data, 200, [], ['groups' => ['default']]);
    }
}
