<?php

namespace App\Controller;

use App\Entity\PublishingHouse;
use App\Repository\PublishingHouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlleur d'api pour les maisons d'éditions
 */
class ApiPublishingHouseController extends AbstractController
{
    /**
     * Liste toutes les maisons d'édition
     */
    #[Route('/api/publishing-houses', name: 'app_api_publishing_house_list')]
    public function list(PublishingHouseRepository $repository): Response
    {
        return $this->json($repository->findAll());
    }

    /**
     * Affiche une maisons d'édition
     */
    #[Route('/api/publishing-houses/{id}', name: 'app_api_publishing_house_show')]
    public function show(PublishingHouse $house): Response
    {
        return $this->json($house);
    }
}
