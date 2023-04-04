<?php

namespace App\Controller;

use App\Form\RegistrationType;
use App\Repository\UserRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route('/inscription', name: 'app_user_registration')]
    public function registration(
        Request $request,
        UserPasswordHasherInterface $encoder,
        UserRepository $repository,
    ): Response {
        // Je créé le formulaire
        $form = $this->createForm(RegistrationType::class);

        // Je remplie le formulaire avec les données de l'utilisateur
        $form->handleRequest($request);

        // Je valide le formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // Je récupére l'utilisateur du formulaire
            $user = $form
                ->getData()
                // On spécifie les dates
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime())
                // On encrypte le mot de passe
                ->setPassword($encoder->hashPassword(
                    $form->getData(),
                    $form->getData()->getPassword()
                ));

            // J'enregistre l'utilisateur
            $repository->save($user, true);

            // @TODO : Je redirige vers la page de connexion
            return new Response('OK');
        }

        // J'affiche la page d'inscription
        return $this->render('user/registration.html.twig', [
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
}
