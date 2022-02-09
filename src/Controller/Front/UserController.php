<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Form\SubscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_front_user_subscription")
     */
    public function subscription(
        Request $request,
        UserPasswordHasherInterface $crypter,
        EntityManagerInterface $manager,
    ): Response {
        $form = $this->createForm(SubscriptionType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // @TODO gérer les roles

            // Cryptage du mot de passe
            $user->setPassword($crypter->hashPassword(
                $user,
                $user->getPassword(),
            ));

            // Enregistrement dans la base de données
            $manager->persist($user);
            $manager->flush();

            // @TODO Rediriger vers la page de connexion
            return new Response('Inscription OK');
        }

        return $this->render('front/user/subscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
