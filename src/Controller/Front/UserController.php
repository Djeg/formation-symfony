<?php

namespace App\Controller\Front;

use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Voici le controlleur permettant de gérer les utilisateur sur
 * la partie public de PizzaShop.
 */
class UserController extends AbstractController
{
    /**
     * Voici la route permettant de se connécter à l'application
     */
    #[Route(path: '/connexion', name: 'app_front_user_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_front_home_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('front/user/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * Voici la route permettant de se déconnécter de l'application
     */
    #[Route(path: '/deconnexion', name: 'app_front_user_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * Voici la route permettant à un utilisateur de s'inscrire
     * sur pizza shop
     */
    #[Route('/inscription', name: 'app_front_user_signUp')]
    public function signUp(
        Request $request,
        UserRepository $repository,
        UserPasswordHasherInterface $hasher,
    ): Response {
        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $user->setPassword($hasher->hashPassword(
                $user,
                $user->getPassword(),
            ));

            $repository->add($user);

            return $this->redirectToRoute('app_front_user_login');
        }

        return $this->render('front/user/signUp.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
