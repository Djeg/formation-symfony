<?php

namespace App\Controller;

use App\Form\RegistrationType;
use App\Repository\AccountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    /**
     * Page d'inscription pour un nouveau compte
     */
    #[Route('/inscription', name: 'app_account_create', methods: ['GET', 'POST'])]
    public function create(Request $request, AccountRepository $repository, UserPasswordHasherInterface $hasher): Response
    {
        // Création de formulaire
        $form = $this->createForm(RegistrationType::class);

        // Remplissage du formulaire
        $form->handleRequest($request);

        // On test si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            $account = $form->getData();

            // Crytage du mot de passe en utilisant le UserPasswordHasherInterface :
            $account->setPassword($hasher->hashPassword(
                $account,
                $account->getPassword(),
            ));

            // On enregistre le nouveau compte dans la base de données
            $repository->save($account, true);

            // On redirige vers la page d'accueil
            // @TODO rediriger vers une page de bienvenue
            return $this->redirectToRoute('app_home_home');
        }

        // on affiche la page d'inscription
        return $this->render('account/create.html.twig', [
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

        return $this->render('account/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/deconnexion', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
