<?php

namespace App\Controller;

use App\Entity\PublishingHouse;
use App\Form\ApiPublishingHouseType;
use App\Form\PublishingHouseSearchType;
use App\Repository\PublishingHouseRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlleur d'api pour les maisons d'éditions
 */
class ApiPublishingHouseController extends AbstractController
{
    /**
     * Liste toute les maisons d'édition
     */
    #[Route('/api/publishing-houses', name: 'app_api_publishing_house_list', methods: ['GET'])]
    public function list(PublishingHouseRepository $repository, Request $request): Response
    {
        // Je créé mon formulaire de recherche
        $form = $this->createForm(PublishingHouseSearchType::class);

        // Je remplie les données du formulaire
        $form->handleRequest($request);

        // Je récupére les critères de recherche
        $criteria = $form->getData();

        // Je lance la recherche en utilisant le repository
        $pubHouses = $repository->findAllByCriteria($criteria);

        return $this->json($pubHouses);
    }

    /**
     * Affiche une seul maison d'édition
     */
    #[Route('/api/publishing-houses/{id}', name: 'app_api_publishing_house_show', methods: ['GET'])]
    public function show(PublishingHouse $pubHouse): Response
    {
        return $this->json($pubHouse);
    }

    /**
     * Créer une nouvelle maison d'édition
     */
    #[Route('/api/publishing-houses', name: 'app_api_publishing_house_create', methods: ['POST'])]
    public function create(Request $request, PublishingHouseRepository $repository): Response
    {
        // Je créé le formulaire
        $form = $this->createForm(ApiPublishingHouseType::class);

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

        // Je retourne la maison d'édition en json
        return $this->json($form->getData(), 201);
    }

    /**
     * Edite une maison d'édition
     */
    #[Route('/api/publishing-houses/{id}', name: 'app_api_publishing_house_edit', methods: ['PATCH'])]
    public function edit(PublishingHouse $pubHouse, PublishingHouseRepository $repository, Request $request): Response
    {
        // Création du formulaire
        $form = $this->createForm(ApiPublishingHouseType::class, $pubHouse, [
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
        $repository->save($pubHouse->setUpdatedAt(new DateTime()), true);

        // On affiche la maison d'édition :)
        return $this->json($pubHouse);
    }

    /**
     * Suppression d'une maison d'édition
     */
    #[Route('/api/publishing-houses/{id}', name: 'app_api_publishing_house_remove', methods: ['DELETE'])]
    public function remove(PublishingHouse $pubHouse, PublishingHouseRepository $repository): Response
    {
        // Suppressuion de la maisons d'édition
        $repository->remove($pubHouse, true);

        // On retourne la maison d'édition
        return $this->json($pubHouse);
    }
}
