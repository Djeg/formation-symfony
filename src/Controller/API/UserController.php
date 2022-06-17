<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\DTO\SearchUserCriteria;
use App\Entity\User;
use App\Form\API\ApiRegistrationType;
use App\Form\API\ApiSearchUserType;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users')]
class UserController extends AbstractController
{
    #[Route('', name: 'app_api_user_list', methods: ['GET'])]
    public function list(UserRepository $repository, Request $request): Response
    {
        // Création des critères de recherche
        $criteria = new SearchUserCriteria();

        // Création du formulaire de recherche
        $form = $this->createForm(ApiSearchUserType::class, $criteria);

        // On remplie le formulaire
        $form->handleRequest($request);

        // Récupération de tout les utilisateurs
        $users = $repository->findByCriteria($criteria);

        // On retourne la collection d'utilisateur
        return $this->json($users);
    }

    #[Route('/{id}', name: 'app_api_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        // On retourne l'utilisateur en JSON
        return $this->json($user);
    }

    #[Route('', name: 'app_api_user_create', methods: ['POST'])]
    public function create(Request $request, UserRepository $repository, UserPasswordHasherInterface $hasher): Response
    {
        // Création d'un formulaire
        $form = $this->createForm(ApiRegistrationType::class);

        // On remplie le formulaire
        $form->handleRequest($request);

        // On test si il est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupére l'utilisateur créé par le formulaire
            $user = $form->getData();

            // On crypte le mot de passe
            $user->setPassword($hasher->hashPassword($user, $user->getPassword()));

            // Si c'est bon, on enregistre l'utilisateur
            $repository->add($user, true);

            // On retourne l'utilisateur créé en json !
            return $this->json($user, 201);
        }

        // Si ce n'est pas le cas on retourne une erreur 400 avec
        // les erreurs du formulaire en JSON
        return $this->json($form->getErrors(), 400);
    }
}
