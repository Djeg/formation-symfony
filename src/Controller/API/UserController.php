<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_api_user_list', methods: ['GET'])]
    public function list(UserRepository $repository): Response
    {
        // Récupération de tout les utilisateurs
        $users = $repository->findAll();

        // On retourne la collection d'utilisateur
        return $this->json($users);
    }

    #[Route('/{id}', name: 'app_api_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->json($user);
    }
}
