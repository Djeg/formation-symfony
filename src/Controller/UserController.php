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
 * Controller contenant toutes les pages qui concerne les utilisateurs
 */
class UserController extends AbstractController
{
    /**
     * Page d'inscription à l'application
     */
    #[Route('/inscription', name: 'app_user_signUp')]
    public function signUp(Request $request, UserPasswordHasherInterface $encoder, UserRepository $repository): Response
    {
        // je créer le formulaire d'inscription
        $form = $this->createForm(SignUpType::class);

        // Je remplie le formulaire
        $form->handleRequest($request);

        // Je test que le formulaires est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Je récupére le user du formulaire
            $user = $form->getData();

            // Je crypte le mot de passe de l'utilisateur
            $password = $user->getPassword();
            $cryptedPassword = $encoder->hashPassword($user, $password);
            $user->setPassword($cryptedPassword);

            // J'enregistre le user du formulaire dans la base de données
            $repository->save($user, true);

            // @TODO Je redirige vers la page de connexion
            return new Response('OK');
        }

        // J'affiche le formulaire d'inscription
        return $this->render('user/signUp.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
