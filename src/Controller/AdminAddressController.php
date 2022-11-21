<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use App\Repository\AddressRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ce controller gére toutes les pages concernant les addresses
 */
class AdminAddressController extends AbstractController
{
    /**
     * Liste toutes les adresses
     */
    #[Route('/admin/adresses', name: 'app_adminAddress_list', methods: ['GET'])]
    public function list(AddressRepository $repository): Response
    {
        // Récupére toutes les addresses
        $addresses = $repository->findAll();

        // Afficher la liste des adresses
        return $this->render('adminAddress/list.html.twig', [
            'addresses' => $addresses,
        ]);
    }

    /**
     * Créer une nouvelle adresse
     */
    #[Route('/admin/adresses/nouvelle', name: 'app_adminAddress_create', methods: ['GET', 'POST'])]
    public function create(Request $request, AddressRepository $repository): Response
    {
        // Création du formulaire
        $form = $this->createForm(AddressType::class);

        // On remplie le formulaire
        $form->handleRequest($request);

        // On test si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // on récupére notre adresse :
            $address = $form->getData();

            // On met à jour les dates
            $address
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime());

            // on enregistre l'adresse en base de données
            $repository->save($address, true);

            // On redirige vers la liste
            return $this->redirectToRoute('app_adminAddress_list');
        }

        // On affiche le formulaire
        return $this->render('adminAddress/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Met à jour une adresse
     */
    #[Route('/admin/adresses/{id}', name: 'app_adminAddress_update', methods: ['GET', 'POST'])]
    public function update(Address $address, Request $request, AddressRepository $repository): Response
    {
        // Création du formulaire
        $form = $this->createForm(AddressType::class, $address);

        // On remplie le formulaire
        $form->handleRequest($request);

        // On test si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On met à jour les dates
            $address
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime());

            // on enregistre l'adresse en base de données
            $repository->save($address, true);

            // On redirige vers la liste
            return $this->redirectToRoute('app_adminAddress_list');
        }

        // On affiche le formulaire
        return $this->render('adminAdress/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprime une adresse
     */
    #[Route('/admin/adresses/{id}/supprimer', name: 'app_adminAddress_remove', methods: ['GET'])]
    public function remove(Address $address, AddressRepository $repository): Response
    {
        // Je supprime l'adresse :
        $repository->remove($address, true);

        // je redirige vers la liste
        return $this->redirectToRoute('app_adminAddress_list');
    }
}