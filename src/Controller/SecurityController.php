<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/inscription', name: 'app_security_registration')]
    public function registration(Request $request, UserRepository $repository, UserPasswordHasherInterface $hasher): Response
    {
        // Création du formulaire
        $form = $this->createForm(RegistrationType::class);

        // On rempli le formulaire avec les données de l'utilisateur
        $form->handleRequest($request);

        // Test si le formulaire a était envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // ON récupére le nouvel utilisateur
            $user = $form->getData();

            // Crypter le mot de passe
            $cryptedPassword = $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($cryptedPassword);

            // Enregistrement en base de données
            $repository->add($user, true);

            // redirection vers la page d'accueil
            return $this->redirectToRoute('app_front_home_home');
        }

        // Afficher la page HTML
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/connexion', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/deconnexion', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
