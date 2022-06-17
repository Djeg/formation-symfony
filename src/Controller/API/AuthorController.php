<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\DTO\SearchAuthorCriteria;
use App\Entity\Author;
use App\Form\API\ApiAuthorType;
use App\Form\API\ApiSearchAuthorType;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/authors')]
class AuthorController extends AbstractController
{
    #[Route('', name: 'app_api_author_list', methods: ['GET'])]
    public function list(Request $request, AuthorRepository $repository): Response
    {
        $criteria = new SearchAuthorCriteria();

        $form = $this->createForm(ApiSearchAuthorType::class, $criteria);

        $form->handleRequest($request);

        $authors = $repository->findByCriteria($criteria);

        return $this->json($authors);
    }

    #[Route('', name: 'app_api_author_create', methods: ['POST'])]
    public function create(Request $request, AuthorRepository $repository): Response
    {
        $form = $this->createForm(ApiAuthorType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->add($form->getData(), true);

            return $this->json($form->getData(), 201);
        }

        return $this->json($form->getErrors(), 400);
    }

    #[Route('/{id}', name: 'app_api_author_show', methods: ['GET'])]
    public function show(Author $author): Response
    {
        return $this->json($author);
    }

    #[Route('/{id}', name: 'app_api_author_update', methods: ['PATCH'])]
    public function update(Author $author, Request $request, AuthorRepository $repository): Response
    {
        $form = $this->createForm(ApiAuthorType::class, $author, [
            'method' => 'PATCH',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->add($form->getData(), true);

            return $this->json($form->getData());
        }

        return $this->json($form->getErrors(), 400);
    }

    #[Route('/{id}', name: 'app_api_author_remove', methods: ['DELETE'])]
    public function remove(Author $author, AuthorRepository $repository): Response
    {
        $repository->remove($author, true);

        return $this->json($author);
    }
}
