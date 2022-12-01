<?php

namespace App\Controller;

use App\Controller\Helper\ApiControllerHelper;
use App\DTO\UserSearchCriteria;
use App\Entity\User;
use App\Form\ApiUserType;
use App\Form\SearchUserType;
use App\Repository\UserRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

/**
 * Ce controller contient toutes les routes de l'API pour gérer les users
 */
class ApiUserController extends AbstractController
{
    use ApiControllerHelper;

    /**
     * Créer un nouvel utilisateur sur notre api
     */
    #[OA\Tag(name: 'Users')]
    #[OA\RequestBody(content: new Model(type: User::class, groups: ['api_create']))]
    #[OA\Response(
        response: 201,
        description: 'Créé un nouveau user',
        content: new Model(type: User::class, groups: ['default'])
    )]
    #[Route('/api/users', name: 'app_apiUser_create', methods: ['POST'])]
    public function create(Request $request, UserRepository $repository): Response
    {
        return $this->apiInsert(
            ApiUserType::class,
            $request,
            $repository,
        );
    }

    /**
     * Liste et recherche des users de l'api
     */
    #[OA\Tag(name: 'Users')]
    #[OA\Parameter(
        in: 'query',
        name: 'userCriterias',
        schema: new OA\Schema(ref: new Model(type: UserSearchCriteria::class), required: [])
    )]
    #[OA\Response(
        response: 200,
        description: 'La liste des users',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: User::class, groups: ['default']))
        )
    )]
    #[Route('/api/users', name: 'app_apiUser_list', methods: ['GET'])]
    public function list(Request $request, UserRepository $repository): Response
    {
        return $this->apiList(
            SearchUserType::class,
            $request,
            $repository,
        );
    }

    /**
     * Met à jour un user
     */
    #[OA\Tag(name: 'Users')]
    #[OA\RequestBody(content: new Model(type: User::class, groups: ['api_create']))]
    #[OA\Response(
        response: 201,
        description: 'Met à jour un user',
        content: new Model(type: User::class, groups: ['default'])
    )]
    #[Route('/api/users/{id}', name: 'app_apiUser_update', methods: ['PATCH'])]
    public function update(User $user, UserRepository $repository, Request $request): Response
    {
        return $this->apiInsert(
            ApiUserType::class,
            $request,
            $repository,
            $user,
        );
    }

    /**
     * On supprime un user
     */
    #[OA\Tag(name: 'Users')]
    #[OA\Response(
        response: 200,
        description: 'Supprime un user',
        content: new Model(type: User::class, groups: ['default'])
    )]
    #[Route('/api/users/{id}', name: 'app_apiUser_remove', methods: ['DELETE'])]
    public function remove(User $user, UserRepository $repository): Response
    {
        return $this->apiRemove($user, $repository);
    }

    /**
     * On récupére un user
     */
    #[OA\Tag(name: 'Users')]
    #[OA\Response(
        response: 200,
        description: 'Récupération d\'un user',
        content: new Model(type: User::class, groups: ['default'])
    )]
    #[Route('/api/users/{id}', name: 'app_apiUser_get', methods: ['GET'])]
    public function get(User $user): Response
    {
        return $this->apiGet($user);
    }
}
