<?php

namespace App\Controller;

use App\Controller\Helper\ApiControllerHelper;
use App\DTO\AdSearchCriteria;
use App\Entity\Ad;
use App\Form\ApiAdType;
use App\Form\SearchAdType;
use App\Repository\AdRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

/**
 * Ce controller contient toutes les routes de l'API pour gérer les ads
 */
class ApiAdController extends AbstractController
{
    use ApiControllerHelper;

    /**
     * Créer une nouvelle annonce sur notre api
     */
    #[OA\Tag(name: 'Ads')]
    #[OA\RequestBody(content: new Model(type: Ad::class, groups: ['api_create']))]
    #[OA\Response(
        response: 201,
        description: 'Créé un nouveau ad',
        content: new Model(type: Ad::class, groups: ['default'])
    )]
    #[Route('/api/ads', name: 'app_apiAd_create', methods: ['POST'])]
    public function create(Request $request, AdRepository $repository): Response
    {
        return $this->apiInsert(
            ApiAdType::class,
            $request,
            $repository,
        );
    }

    /**
     * Liste et recherche des ads de l'api
     */
    #[OA\Tag(name: 'Ads')]
    #[OA\Parameter(
        in: 'query',
        name: 'adCriterias',
        schema: new OA\Schema(ref: new Model(type: AdSearchCriteria::class), required: [])
    )]
    #[OA\Response(
        response: 200,
        description: 'La liste des ads',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Ad::class, groups: ['default']))
        )
    )]
    #[Route('/api/ads', name: 'app_apiAd_list', methods: ['GET'])]
    public function list(Request $request, AdRepository $repository): Response
    {
        return $this->apiList(
            SearchAdType::class,
            $request,
            $repository,
        );
    }

    /**
     * Met à jour un ad
     */
    #[OA\Tag(name: 'Ads')]
    #[OA\RequestBody(content: new Model(type: Ad::class, groups: ['api_create']))]
    #[OA\Response(
        response: 201,
        description: 'Met à jour un ad',
        content: new Model(type: Ad::class, groups: ['default'])
    )]
    #[Route('/api/ads/{id}', name: 'app_apiAd_update', methods: ['PATCH'])]
    public function update(Ad $ad, AdRepository $repository, Request $request): Response
    {
        return $this->apiInsert(
            ApiAdType::class,
            $request,
            $repository,
            $ad,
        );
    }

    /**
     * On supprime un ad
     */
    #[OA\Tag(name: 'Ads')]
    #[OA\Response(
        response: 200,
        description: 'Supprime un ad',
        content: new Model(type: Ad::class, groups: ['default'])
    )]
    #[Route('/api/ads/{id}', name: 'app_apiAd_remove', methods: ['DELETE'])]
    public function remove(Ad $ad, AdRepository $repository): Response
    {
        return $this->apiRemove($ad, $repository);
    }

    /**
     * On récupére un ad
     */
    #[OA\Tag(name: 'Ads')]
    #[OA\Response(
        response: 200,
        description: 'Récupération d\'un ad',
        content: new Model(type: Ad::class, groups: ['default'])
    )]
    #[Route('/api/ads/{id}', name: 'app_apiAd_get', methods: ['GET'])]
    public function get(Ad $ad): Response
    {
        return $this->apiGet($ad);
    }
}
