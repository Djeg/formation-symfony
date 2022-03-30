<?php

namespace App\Controller;

use App\Form\Front\ProfilType;
use App\Form\Front\SignInType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
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

    #[Route('/inscription', name: 'app_security_signIn')]
    public function signIn(
        Request $request,
        UserPasswordHasherInterface $crypter,
        UserRepository $repository,
    ): Response {
        $form = $this->createForm(SignInType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // $crypter->isPasswordValid($user, 'coucoulesamis');

            // Cryptage du mot de passe !
            $user->setPassword($crypter->hashPassword(
                $user,
                $user->getPassword(),
            ));

            $repository->add($user);

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/signIn.html.twig', [
            'formView' => $form->createView(),
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/mon-profile', name: 'app_security_profil')]
    public function profil(
        Request $request,
        UserPasswordHasherInterface $crypter,
        UserRepository $repository,
    ): Response {
        $form = $this->createForm(ProfilType::class, $this->getUser());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $user->setPassword($crypter->hashPassword(
                $user,
                $user->getPassword(),
            ));

            $repository->add($user);

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/profil.html.twig', [
            'formView' => $form->createView(),
        ]);
    }
}
