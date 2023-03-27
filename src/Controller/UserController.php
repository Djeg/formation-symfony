<?php

namespace App\Controller;

use App\Form\SignUpType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

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
}
