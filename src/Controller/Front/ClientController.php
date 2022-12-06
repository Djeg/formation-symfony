<?php

namespace App\Controller\Front;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Controlleur frontend pour les clients. C'est ici qu'on retrouve
 * la connexion, inscription et le profil d'un client.
 */
class ClientController extends AbstractController
{
    /**
     * Création d'un nouveau compte
     */
    #[Route('/inscription', name: 'app_front_client_registration', methods: ['GET', 'POST'])]
    public function registration(Request $request, UserPasswordHasherInterface $hasher, ClientRepository $repository): Response
    {
        // création du formulaire
        $form = $this->createForm(ClientType::class);
        $form->handleRequest($request);

        // Test la validité du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // cryptage du mot de passe du client
            $form->getData()->setPassword($hasher->hashPassword(
                $form->getData(),
                $form->getData()->getPassword(),
            ));

            // enregistrement du nouveau client dans la base de données
            $repository->save($form->getData(), true);

            // on redirige sur la page de bienvenue
            return $this->redirectToRoute('app_client_welcome', [
                'id' => $form->getData()->getId(),
            ]);
        }

        // on affiche la page d'inscription
        return $this->render('front/client/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Page de bienvenue d'un nouveau client
     */
    #[Route('/bienvenue/{id}', name: 'app_front_client_welcome', methods: ['GET'])]
    public function welcome(Client $client): Response
    {
        // on affiche la page de bienvenue
        return $this->render('front/client/welcome.html.twig', [
            'client' => $client,
        ]);
    }

    /**
     * Page de connexion à l'application
     */
    #[Route(path: '/connexion', name: 'app_front_client_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // récupération de la dernière erreur de connexion si il en a une
        $error = $authenticationUtils->getLastAuthenticationError();

        // le dernier nom d'utilisateur entrée
        $lastUsername = $authenticationUtils->getLastUsername();

        // on affiche le formulaire de connexion
        return $this->render('front/client/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * Page de deconnexion
     */
    #[Route(path: '/deconnexion', name: 'app_front_client_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * Page d'affichage et d'édition du profile d'un utilisateur
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/mon-profil', name: 'app_front_client_profile', methods: ['GET', 'POST'])]
    public function profile(Request $request, ClientRepository $repository): Response
    {
        /**
         * @var Client
         */
        $client = $this->getUser();

        // Création du formulaire d'édition des informations personnel
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        // test de la validité du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // on enregistre les données en base de données
            $repository->save($client, true);
        }

        // on affiche la page du profile
        return $this->render('front/client/profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
