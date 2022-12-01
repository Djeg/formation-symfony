<?php

namespace App\Controller;

use App\Controller\Helper\ApiControllerHelper;
use App\DTO\AddressSearchCriteria;
use App\Entity\Address;
use App\Form\AddressSearchType;
use App\Form\AddressType;
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
    use ApiControllerHelper;

    /**
     * Route de création d'une address dans notre api
     */
    #[OA\Tag(name: 'Address')]
    #[OA\Response(
        response: 201,
        description: 'The address has been created successfully',
        content: new Model(type: Address::class, groups: ['default']),
    )]
    #[OA\RequestBody(content: new Model(type: Address::class, groups: ['api_create']))]
    #[Route('/api/addresses', name: 'app_apiAddress_create', methods: ['POST'])]
    public function create(AddressRepository $repository, Request $request): Response
    {
        return $this->apiInsert(
            AddressType::class,
            $request,
            $repository,
        );
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
        return $this->apiList(
            AddressSearchType::class,
            $request,
            $repository,
        );
    }

    /**
     * Met à jour une address
     */
    #[OA\Tag(name: 'Address')]
    #[OA\Response(
        response: 200,
        description: 'The address has been updated successfully',
        content: new Model(type: Address::class, groups: ['default']),
    )]
    #[OA\RequestBody(content: new Model(type: Address::class, groups: ['api_create']))]
    #[Route('/api/addresses/{id}', name: 'app_apiAddress_update', methods: ['PATCH'])]
    public function update(Address $address, AddressRepository $repository, Request $request): Response
    {
        return $this->apiInsert(
            AddressType::class,
            $request,
            $repository,
            $address,
        );
    }

    /**
     * Supprime une adresse
     */
    #[Route('/api/addresses/{id}', name: 'app_apiAddress_remove', methods: ['DELETE'])]
    #[OA\Tag(name: 'Address')]
    #[OA\Response(
        response: 200,
        description: 'The address has been removed successfully',
        content: new Model(type: Address::class, groups: ['default']),
    )]
    public function remove(Address $address, AddressRepository $repository): Response
    {
        return $this->apiRemove($address, $repository);
    }

    /**
     * Récupére une adresse par son identifiant
     */
    #[Route('/api/addresses/{id}', name: 'app_apiAddress_get', methods: ['GET'])]
    #[OA\Tag(name: 'Address')]
    #[OA\Response(
        response: 200,
        description: 'The address has been retrieved successfully',
        content: new Model(type: Address::class, groups: ['default']),
    )]
    public function get(Address $address): Response
    {
        return $this->apiGet($address);
    }
}
