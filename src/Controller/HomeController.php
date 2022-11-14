<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ce controller contient le code de la page d'accueil
 */
class HomeController extends AbstractController
{
    /**
     * Affiche la page d'accueil
     */
    #[Route('/', name: 'app_home_index', methods: ['GET'])]
    public function index(): Response
    {
        return new Response("Page d'accueil");
    }
}
