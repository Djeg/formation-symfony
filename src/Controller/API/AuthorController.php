<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Entity\Author;
use App\Form\API\ApiAuthorType;
use App\Form\API\ApiSearchAuthorType;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/api/authors', name: 'app_api_author_list', methods: ['GET'])]
    public function list(AuthorRepository $repository, Request $request): Response
    {
        $form = $this->createForm(ApiSearchAuthorType::class);

        $form->handleRequest($request);

        $authors = $repository->findBySearch($form->getData());

        return $this->json($authors);
    }

    #[Route('/api/authors', name: 'app_api_author_create', methods: ['POST'])]
    public function create(Request $request, AuthorRepository $repository): Response
    {
        $form = $this->createForm(ApiAuthorType::class, new Author(), [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->json($form->getErrors(), 400);
        }

        $repository->add($form->getData());

        return $this->json($form->getData(), 201);
    }

    #[Route('/api/authors/{id}', name: 'app_api_author_update', methods: ['PATCH'])]
    public function update(Author $author, Request $request, AuthorRepository $repository): Response
    {
        $form = $this->createForm(ApiAuthorType::class, $author, [
            'method' => 'PATCH',
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->json($form->getErrors(), 400);
        }

        $repository->add($form->getData());

        return $this->json($form->getData());
    }

    #[Route('/api/authors/{id}', name: 'app_api_author_delete', methods: ['DELETE'])]
    public function delete(Author $author, AuthorRepository $repository): Response
    {
        $repository->remove($author);

        return $this->json($author);
    }
}
