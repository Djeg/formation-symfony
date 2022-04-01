<?php

declare(strict_types=1);

namespace App\Controller\API;

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
}
