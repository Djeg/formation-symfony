<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\PublishingHouse;
use App\Form\AdminPublishingHouseType;
use App\Repository\PublishingHouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublishingHouseController extends AbstractController
{
    #[Route('/admin/maisons-edition/nouvelle', name: 'app_admin_publishingHouse_create')]
    public function create(Request $request, PublishingHouseRepository $repository): Response
    {
        // Creation du formulaire
        $form = $this->createForm(AdminPublishingHouseType::class);

        // On remplie le formulaire avec les données de l'utilisateur
        $form->handleRequest($request);

        // Test si le formulaire est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupére la maison d'edition
            $house = $form->getData();

            // Enregistrement de la maison d'édition en base de données
            $repository->add($house, true);

            // Redirection vers la page de la liste
            return $this->redirectToRoute('app_admin_publishingHouse_list');
        }

        // On affiche la page HTML
        return $this->render('admin/publishingHouse/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/maisons-edition', name: 'app_admin_publishingHouse_list')]
    public function list(PublishingHouseRepository $repository): Response
    {
        // Récupération de toutes les maisons d'édition
        $houses = $repository->findAll();

        // On affiche le HTML
        return $this->render('admin/publishingHouse/list.html.twig', [
            'houses' => $houses,
        ]);
    }

    #[Route('/admin/maisons-edition/{id}', name: 'app_admin_publishingHouse_update')]
    public function update(PublishingHouse $house, Request $request, PublishingHouseRepository $repository): Response
    {
        // Creation du formulaire
        $form = $this->createForm(AdminPublishingHouseType::class, $house);

        // On remplie le formulaire avec les données de l'utilisateur
        $form->handleRequest($request);

        // Test si le formulaire est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupére la maison d'edition
            $house = $form->getData();

            // Enregistrement de la maison d'édition en base de données
            $repository->add($house, true);

            // Redirection vers la page de la liste
            return $this->redirectToRoute('app_admin_publishingHouse_list');
        }

        // On affiche la page HTML
        return $this->render('admin/publishingHouse/update.html.twig', [
            'form' => $form->createView(),
            'house' => $house,
        ]);
    }

    #[Route('/admin/maisons-edition/{id}/supprimer', name: 'app_admin_publishingHouse_remove')]
    public function remove(PublishingHouse $house, PublishingHouseRepository $repository): Response
    {
        // Suppression de la maison d'édition de la base de données
        $repository->remove($house, true);

        // Redirection vers la page de la liste
        return $this->redirectToRoute('app_admin_publishingHouse_list');
    }
}
