<?php

namespace App\Controller;

use App\Controller\Helper\ApiControllerHelper;
use App\DTO\AccountSearchCriteria;
use App\Entity\Account;
use App\Form\ApiAccountType;
use App\Form\SearchAccountType;
use App\Repository\AccountRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

/**
 * Ce controller contient toutes les routes de l'API pour gérer les accounts
 */
class ApiAccountController extends AbstractController
{
    use ApiControllerHelper;

    /**
     * Créer un nouvel compte sur notre api
     */
    #[OA\Tag(name: 'Accounts')]
    #[OA\RequestBody(content: new Model(type: Account::class, groups: ['api_create']))]
    #[OA\Response(
        response: 201,
        description: 'Créé un nouveau account',
        content: new Model(type: Account::class, groups: ['default'])
    )]
    #[Route('/api/accounts', name: 'app_apiAccount_create', methods: ['POST'])]
    public function create(Request $request, AccountRepository $repository): Response
    {
        return $this->apiInsert(
            ApiAccountType::class,
            $request,
            $repository,
        );
    }

    /**
     * Liste et recherche des accounts de l'api
     */
    #[OA\Tag(name: 'Accounts')]
    #[OA\Parameter(
        in: 'query',
        name: 'accountCriterias',
        schema: new OA\Schema(ref: new Model(type: AccountSearchCriteria::class), required: [])
    )]
    #[OA\Response(
        response: 200,
        description: 'La liste des accounts',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Account::class, groups: ['default']))
        )
    )]
    #[Route('/api/accounts', name: 'app_apiAccount_list', methods: ['GET'])]
    public function list(Request $request, AccountRepository $repository): Response
    {
        return $this->apiList(
            SearchAccountType::class,
            $request,
            $repository,
        );
    }

    /**
     * Met à jour un account
     */
    #[OA\Tag(name: 'Accounts')]
    #[OA\RequestBody(content: new Model(type: Account::class, groups: ['api_create']))]
    #[OA\Response(
        response: 201,
        description: 'Met à jour un account',
        content: new Model(type: Account::class, groups: ['default'])
    )]
    #[Route('/api/accounts/{id}', name: 'app_apiAccount_update', methods: ['PATCH'])]
    public function update(Account $account, AccountRepository $repository, Request $request): Response
    {
        return $this->apiInsert(
            ApiAccountType::class,
            $request,
            $repository,
            $account,
        );
    }

    /**
     * On supprime un account
     */
    #[OA\Tag(name: 'Accounts')]
    #[OA\Response(
        response: 200,
        description: 'Supprime un account',
        content: new Model(type: Account::class, groups: ['default'])
    )]
    #[Route('/api/accounts/{id}', name: 'app_apiAccount_remove', methods: ['DELETE'])]
    public function remove(Account $account, AccountRepository $repository): Response
    {
        return $this->apiRemove($account, $repository);
    }

    /**
     * On récupére un account
     */
    #[OA\Tag(name: 'Accounts')]
    #[OA\Response(
        response: 200,
        description: 'Récupération d\'un account',
        content: new Model(type: Account::class, groups: ['default'])
    )]
    #[Route('/api/accounts/{id}', name: 'app_apiAccount_get', methods: ['GET'])]
    public function get(Account $account): Response
    {
        return $this->apiGet($account);
    }
}
