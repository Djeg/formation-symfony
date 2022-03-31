<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/api/authors', name: 'app_api_author_list', methods: ['GET'])]
    public function list(AuthorRepository $repository): Response
    {
        $authors = $repository->findAll();

        return $this->json($authors);
    }
}
