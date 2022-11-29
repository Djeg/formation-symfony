<?php

namespace App\Controller;

use App\Form\AddressSearchType;
use App\Form\ApiAddressType;
use App\Repository\AddressRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ce controller contient toutes les routes des adresses pour
 * notre api.
 * 
 * - La création
 */
class ApiAddressController extends AbstractController
{
    /**
     * Route de création d'une address dans notre api
     */
    #[Route('/api/addresses', name: 'app_apiAddress_create', methods: ['POST'])]
    public function create(AddressRepository $repository, Request $request): Response
    {
        // créer le formulaire
        $form = $this->createForm(ApiAddressType::class);

        // remplie le formulaire
        $form->handleRequest($request);

        // on test sa validité
        if (!$form->isSubmitted() || !$form->isValid()) {
            // si non valide, on retourne les erreur du form avec le
            // code HTTP : 400
            return $this->json($form->getErrors(), 400);
        }

        // si valide : on créé les dates
        $address = $form->getData();
        $address->setCreatedAt(new DateTime())->setUpdatedAt(new DateTime());

        // si valide : on sauvegarde l'adresse
        $repository->save($address, true);

        // si valide : on « serialise » en JSON l'adresse que l'on vient de créer,
        // et on retourne le code HTTP : 201 !
        return $this->json($address, 201);
    }

    /**
     * Liste les adresses
     */
    #[Route('/api/addresses', name: 'app_apiAddress_list', methods: ['GET'])]
    public function list(AddressRepository $repository, Request $request): Response
    {
        // Création du formulaire, et on le remplie
        $form = $this->createForm(AddressSearchType::class);
        $form->handleRequest($request);

        // On lance la recherche
        $addresses = $repository->findBySearchCriteria($form->getData());

        // On retourne la réponse en json
        return $this->json($addresses);
    }
}
