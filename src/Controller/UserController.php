<?php

namespace App\Controller;

use App\Form\ProfilType;
use App\Form\SignUpType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Controlleur contenant toutes les pages concernant les utilisateurs
 */
class UserController extends AbstractController
{
    /**
     * Page d'inscription d'un utilisateur sur notre application
     */
    #[Route('/inscription', name: 'app_user_signUp')]
    public function signUp(Request $request, UserPasswordHasherInterface $encoder, UserRepository $repository): Response
    {
        // Je créer le formulaire d'inscription
        $form = $this->createForm(SignUpType::class);

        // Je remplie le formulaire avec les données envoyé par l'utilisateur
        $form->handleRequest($request);

        // Je test si le formulaire est envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Je récupére l'utilisateur du formulaire
            $user = $form->getData();

            // Je crypte le mot de passe de l'utilisateur
            $user->setPassword($encoder->hashPassword($user, $user->getPassword()));

            // J'enregistre l'utilisateur dans le dépot des utilisateurs
            $repository->save($user, true);

            // @TODO Je redirige vers la page de connexion
            return new Response('OK');
        }

        // J'affiche la page d'inscription
        return $this->render('user/signUp.html.twig', [
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

        return $this->render('user/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/deconnexion', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * Page d'édition d'un profil utilisateur
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/mon-profil', name: 'app_user_profil')]
    public function profil(Request $request, UserRepository $repository): Response
    {
        // Je créé le formulaire avec l'utilisateur connécté
        $form = $this->createForm(ProfilType::class, $this->getUser());

        // Je remplie le formulaire avec les données saisie par l'utilisateur
        $form->handleRequest($request);

        // Je test si le form est envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // J'enregistre l'utilisateur dans le dépot des users
            $repository->save($this->getUser(), true);

            // @TODO Je redirige vers la page d'accueil
            return new Response('Ok');
        }

        // J'affiche le formulaire d'édition de profil
        return $this->render('user/profil.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
