<?php

namespace App\Controller\Front;

use App\Entity\Client;
use App\Entity\Offer;
use App\Entity\RealProperty;
use App\Form\OfferType;
use App\Repository\OfferRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ce controller contient toutes les routes permettant de gérer les offres
 * d'un client.
 */
#[IsGranted('ROLE_USER')]
class OfferController extends AbstractController
{
    /**
     * Réalise une offre sur un bien immobilier
     */
    #[Route('/offres/{id}', name: 'app_front_offer_make', methods: ['GET', 'POST'])]
    public function make(RealProperty $realProperty, OfferRepository $repository, Request $request): Response
    {
        /**
         * @var Client
         */
        $client = $this->getUser();

        // création du formulaire de l'offre
        $form = $this->createForm(OfferType::class);
        $form->handleRequest($request);

        // test la validité de l'offre
        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Offer
             */
            $offer = $form->getData();

            // On attache le bien immobilier, le client et le status
            $offer
                ->setRealProperty($realProperty)
                ->setClient($client)
                ->setStatus(Offer::STATUS_WAITING);

            // on sauvegarde l'offre
            $repository->save($offer, true);

            // on redirige vers une page de confirmation
            return $this->redirectToRoute('app_front_offer_confirm', [
                'id' => $offer->getId(),
            ]);
        }

        // On affiche la page de création d'offre
        return $this->render('front/offer/make.html.twig', [
            'form' => $form->createView(),
            'realProperty' => $realProperty,
        ]);
    }

    /**
     * Page de confirmation d'une offre
     */
    #[Route('/offres/{id}/confirmation', name: 'app_front_offer_confirm', methods: ['GET'])]
    public function confirm(Offer $offer): Response
    {
        // on retourne la page de confirmation
        return $this->render('front/offer/confirm.html.twig', [
            'offer' => $offer,
        ]);
    }
}
