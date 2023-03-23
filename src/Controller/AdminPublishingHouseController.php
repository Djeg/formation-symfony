<?php

namespace App\Controller;

use App\Entity\PublishingHouse;
use App\Form\PublishingHouseType;
use App\Repository\PublishingHouseRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlleur permettant d'administrer des maisons d'éditions
 */
class AdminPublishingHouseController extends AbstractController
{
    /**
     * Liste toute les maisons d'édition de l'application
     */
    #[Route('/admin/maisons-edition', name: 'app_admin_publishing_house_list')]
    public function list(PublishingHouseRepository $repository): Response
    {
        // Je récupére toutes les maisons d'édition
        $publishingHouses = $repository->findAll();

        // J'affiche la liste des maisons d'éditions
        return $this->render('admin_publishing_house/list.html.twig', [
            'publishingHouses' => $publishingHouses,
        ]);
    }

    /**
     * Création d'une maison d'édition
     */
    #[Route('/admin/maisons-edition/creation', name: 'app_admin_publishing_house_create')]
    public function create(Request $request, PublishingHouseRepository $repository): Response
    {
        // je créé le formulaire
        $form = $this->createForm(PublishingHouseType::class);

        // je remplie le formulaire avec les données saisie par l'utilisateur
        $form->handleRequest($request);

        // je test si le formulaire a bien était envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Je récupére la maison d'édition du formulaire
            $publishingHouse = $form
                ->getData()
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime());

            // J'enregistre la maison d'édition dans la base de données
            $repository->save($publishingHouse, true);

            // je redirige vers la liste des maisons d'édition
            return $this->redirectToRoute('app_admin_publishing_house_list');
        }

        // j'affiche le formulaire de création d'une maison d'édition
        return $this->render('admin_publishing_house/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Modifie une maison d'édition
     */
    #[Route('/admin/maisons-edition/{id}', name: 'app_admin_publishing_house_update')]
    public function update(Request $request, PublishingHouseRepository $repository, PublishingHouse $publishingHouse)
    {
        // je créé le formulaire avec la maison d'édition
        $form = $this->createForm(PublishingHouseType::class, $publishingHouse);

        // je remplie le formulaire avec les données saisie par l'utilisateur
        $form->handleRequest($request);

        // je test si le formulaire a bien était envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // J'enregistre la maison d'édition dans la base de données
            $repository->save($publishingHouse->setUpdatedAt(new DateTime()), true);

            // je redirige vers la liste des maisons d'édition
            return $this->redirectToRoute('app_admin_publishing_house_list');
        }

        // j'affiche le formulaire de création d'une maison d'édition
        return $this->render('admin_publishing_house/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprime une maison d'édition
     */
    #[Route('/admin/maisons-edition/{id}/supprimer', name: 'app_admin_publishing_house_remove')]
    public function remove(PublishingHouse $house, PublishingHouseRepository $repository): Response
    {
        // Je supprime la maison d'édition
        $repository->remove($house, true);

        // Je redirige vers la liste des maisons d'édition
        return $this->redirectToRoute('app_admin_publishing_house_list');
    }
}
