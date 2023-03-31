<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlleur d'api pour les utilisateurs
 */
class ApiUserController extends AbstractController
{
    /**
     * Liste des utilisateurs
     */
    #[Route('/api/users', name: 'app_api_user_list')]
    public function list(UserRepository $repository): Response
    {
        // Voici la première API :
        return $this->json($repository->findAll());
    }

    /**
     * Récupére un utilisateur
     */
    #[Route('/api/users/{id}', name: 'app_api_user_show')]
    public function show(User $user): Response
    {
        return $this->json($user);
    }
}
