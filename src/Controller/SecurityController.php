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
}
