<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ce controller contient le code de toutes les pages
 * qui concerne les utilisateurs du site
 */
class UserController extends AbstractController
{
    /**
     * Page permettant de connécter à un utilisateur
     */
    #[Route('/se-connecter', name: 'app_user_login', methods: ['GET', 'POST'])]
    public function login(): Response
    {
        return new Response("Connexion");
    }

    /**
     * Page permettant de s'inscrire sur le lookbook
     */
    #[Route('/inscription', name: 'app_user_subscribe', methods: ['GET', 'POST'])]
    public function subscribe(): Response
    {
        return new Response('Inscription', 501);
    }
}
