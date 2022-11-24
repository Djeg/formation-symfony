<?php

namespace App\Controller;

use App\Form\RegistrationType;
use App\Repository\AccountRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Ce controller contient les pages relatif à les gestion des comptes
 * et de la sécurité.
 */
class AccountController extends AbstractController
{
    /**
     * Page d'inscription
     */
    #[Route('/inscription', name: 'app_account_registration', methods: ['GET', 'POST'])]
    public function registration(Request $request, AccountRepository $repository, UserPasswordHasherInterface $hasher): Response
    {
        // Création du formulaire
        $form = $this->createForm(RegistrationType::class);

        // On remplie le formulaire
        $form->handleRequest($request);

        // on test si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // on récupére l'account
            $account = $form->getData();

            // on met à jour les dates
            $account->setCreatedAt(new DateTime())->setUpdatedAt(new DateTime());

            // on crypte le mot de passe
            $account->setPassword($hasher->hashPassword(
                $account,
                $account->getPassword(),
            ));

            // On enregistre l'account dans la base de données
            $repository->save($account, true);

            // On redirige
            // @TODO rediriger vers une page de bienvenue
            return $this->redirectToRoute('app_home_home');
        }

        // Afffiche la page d'inscription
        return $this->render('account/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/connexion', name: 'app_account_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('account/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/deconnexion', name: 'app_account_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
