<?php

namespace App\Controller;

use App\DTO\AddressSearchCriteria;
use App\Entity\Address;
use App\Form\AddressSearchType;
use App\Form\ApiAddressType;
use App\Repository\AddressRepository;
use DateTime;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

/**
 * Ce controller contient toutes les routes des adresses pour
 * notre api.
 * 
 * - La création
 * - la liste
 * - la mise à jour
 * - la suppression
 * - la récupération
 */
class ApiAddressController extends AbstractController
{
    /**
     * Route de création d'une address dans notre api
     */
    #[OA\Tag(name: 'Address')]
    #[OA\Response(
        response: 201,
        description: 'The address has been created successfully',
        content: new Model(type: Address::class),
    )]
    #[OA\RequestBody(content: new Model(type: Address::class, groups: ['api_create']))]
    #[Route('/api/addresses', name: 'app_apiAddress_create', methods: ['POST'])]
    public function create(AddressRepository $repository, Request $request): Response
    {
        // créer le formulaire
        $form = $this->createForm(ApiAddressType::class);

        // remplie le formulaire
        $form->handleRequest($request);

        // on test sa validité
        if (!$form->isSubmitted() || !$form->isValid()) {
            // si non valide, on retourne les erreur du form avec le
            // code HTTP : 400
            return $this->json($form->getErrors(), 400);
        }

        // si valide : on créé les dates
        $address = $form->getData();
        $address->setCreatedAt(new DateTime())->setUpdatedAt(new DateTime());

        // si valide : on sauvegarde l'adresse
        $repository->save($address, true);

        // si valide : on « serialise » en JSON l'adresse que l'on vient de créer,
        // et on retourne le code HTTP : 201 !
        return $this->json($address, 201);
    }

    /**
     * Liste les adresses
     */
    #[OA\Tag(name: 'Address')]
    #[OA\Parameter(
        in: 'query',
        name: 'khfsdh',
        schema: new OA\Schema(ref: new Model(type: AddressSearchCriteria::class), required: [])
    )]
    #[OA\Response(
        response: 200,
        description: 'Retourne la collection d\'adresse',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Address::class))
        )
    )]
    #[Route('/api/addresses', name: 'app_apiAddress_list', methods: ['GET'])]
    public function list(AddressRepository $repository, Request $request): Response
    {
        // Création du formulaire, et on le remplie
        $form = $this->createForm(AddressSearchType::class);
        $form->handleRequest($request);

        // On lance la recherche
        $addresses = $repository->findBySearchCriteria($form->getData());

        // On retourne la réponse en json
        return $this->json($addresses);
    }

    /**
     * Met à jour une address
     */
    #[Route('/api/addresses/{id}', name: 'app_apiAddress_update', methods: ['PATCH'])]
    public function update(Address $address, AddressRepository $repository, Request $request): Response
    {
        // créer le formulaire avec l'address et en method PATCH
        $form = $this->createForm(ApiAddressType::class, $address, [
            'method' => 'PATCH',
        ]);

        // remplie le formulaire
        $form->handleRequest($request);

        // on test sa validité
        if (!$form->isSubmitted() || !$form->isValid()) {
            // si non valide, on retourne les erreur du form avec le
            // code HTTP : 400
            return $this->json($form->getErrors(), 400);
        }

        // si valide : on créé les dates
        $address = $form->getData();
        $address->setUpdatedAt(new DateTime());

        // si valide : on sauvegarde l'adresse
        $repository->save($address, true);

        // si valide : on « serialise » en JSON l'adresse que l'on vient de créer,
        // et on retourne le code HTTP : 200 !
        return $this->json($address);
    }

    /**
     * Supprime une adresse
     */
    #[Route('/api/addresses/{id}', name: 'app_apiAddress_remove', methods: ['DELETE'])]
    public function remove(Address $address, AddressRepository $repository): Response
    {
        $repository->remove($address, true);

        return $this->json($address);
    }

    /**
     * Récupére une adresse par son identifiant
     */
    #[Route('/api/addresses/{id}', name: 'app_apiAddress_get', methods: ['GET'])]
    public function get(Address $address): Response
    {
        return $this->json($address);
    }
}
