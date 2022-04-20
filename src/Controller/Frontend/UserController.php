<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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

    #[Route('/mon-profil', name: 'app_frontend_user_profile', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function profile(Request $request, UserRepository $repository, UserPasswordHasherInterface $hasher): Response
    {
        // Création du formulaire d'inscription
        $form = $this->createForm(RegistrationType::class, $this->getUser());

        // On remplie le formulaire avec les données
        // que l'utilisateur à spécifié
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User */
            $user = $form->getData();

            if ($form->get('password')->getData()) {
                $user->setPassword($hasher->hashPassword($user, $form->get('password')->getData()));
            }
            // On crypte le mot de passe de l'utilisateur

            $repository->add($user);
        }

        return $this->render('frontend/user/profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/connexion', name: 'app_frontend_user_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('frontend/user/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/deconnexion', name: 'app_frontend_user_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
