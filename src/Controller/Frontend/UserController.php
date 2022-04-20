<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/inscription', name: 'app_frontend_user_registration', methods: ['GET', 'POST'])]
    public function registration(
        Request $request,
        UserRepository $repository,
        UserPasswordHasherInterface $hasher,
    ): Response {
        // Création du formulaire d'inscription
        $form = $this->createForm(RegistrationType::class, new User());

        // On remplie le formulaire avec les données
        // que l'utilisateur à spécifié
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User */
            $user = $form->getData();

            // On crypte le mot de passe de l'utilisateur
            $user->setPassword($hasher->hashPassword($user, $user->getPassword()));

            $repository->add($user);

            return $this->redirectToRoute('app_frontend_user_login');
        }

        return $this->render('frontend/user/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
