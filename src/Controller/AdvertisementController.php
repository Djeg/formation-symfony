<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ce controller contient toutes les pages concernant les annonces
 * de ventes de livre
 */
class AdvertisementController extends AbstractController
{
    /**
     * Affiche la page de recherche des annonces
     */
    #[Route('/rechercher', name: 'app_advertisement_search', methods: ['GET'])]
    public function search(): Response
    {
        return new Response('Rechercher des annonces');
    }

    /**
     * Affiche la page d'une annonce
     */
    #[Route('/annonces-livres/{id}', name: 'app_advertisement_show', methods: ['GET'])]
    public function show(int $id): Response
    {
        return new Response("Annonce n°$id");
    }
}
