<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiUserController extends AbstractController
{
    #[Route('/api/users', name: 'app_api_user_list')]
    public function list(BookRepository $repository): Response
    {
        // Voici la première API :
        return $this->json($repository->findAll());
    }
}
