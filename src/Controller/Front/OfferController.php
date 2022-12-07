<?php

namespace App\Controller\Front;

use App\Entity\Client;
use App\Entity\Offer;
use App\Entity\RealProperty;
use App\Form\OfferType;
use App\Repository\OfferRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Stripe\StripeClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

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

    /**
     * Paye les frais d'agence d'une offre afin de la terminer. Cette
     * méthode utilise Stripe en tant que service. En effet, vous
     * pouvez déclarer vos propres services dans config/services.yaml !
     */
    #[Route('/offres/{id}/paiment', name: 'app_front_offer_checkout', methods: ['GET'])]
    public function checkout(StripeClient $stripe, Offer $offer): Response
    {
        /**
         * @var Client
         */
        $client = $this->getUser();

        // on test si la commande m'appartient et aussi si la commande
        // est en status  "validé"
        if ($offer->getStatus() !== Offer::STATUS_VALIDATED || !$client->getOffers()->contains($offer)) {
            throw new NotFoundHttpException("L'offre n° {$offer->getId()} ne peut être payée");
        }

        // On génére l'url de paiement
        $checkout = $stripe->checkout->sessions->create([
            'success_url' => $this->generateUrl(
                'app_front_offer_validateCheckout',
                ['id' => $offer->getId()],
                UrlGeneratorInterface::ABSOLUTE_URL,
            ),
            'cancel_url' => $this->generateUrl(
                'app_front_offer_cancelCheckout',
                ['id' => $offer->getId()],
                UrlGeneratorInterface::ABSOLUTE_URL,
            ),
            'mode' => 'payment',
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'EUR',
                        'product_data' => [
                            'name' => $offer->getRealProperty()->getLabel(),
                        ],
                        'unit_amount' => $offer->getAgencyFee() * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
        ]);

        // on redirige sur l'url de paiement
        return $this->redirect($checkout->url);
    }

    /**
     * Page de confirmation de paiement. Cette page est lancé lorsqu'un
     * paiment à bien était éfféctué
     */
    #[Route('/offres/{id}/paiment/confirmation', name: 'app_front_offer_validateCheckout', methods: ['GET'])]
    public function validateCheckout(Offer $offer, OfferRepository $repository): Response
    {
        /**
         * @var Client
         */
        $client = $this->getUser();

        // on test si la commande m'appartient et aussi si la commande
        // est en status  "validé"
        if ($offer->getStatus() !== Offer::STATUS_VALIDATED || !$client->getOffers()->contains($offer)) {
            throw new NotFoundHttpException("L'offre n° {$offer->getId()} ne peut être payée");
        }

        // On valide l'offre
        $offer->setStatus(Offer::STATUS_OVER);

        // on sauvegarde l'offre
        $repository->save($offer, true);

        // on affiche la page de validation
        return $this->render('front/offer/validateCheckout.html.twig', [
            'offer' => $offer,
        ]);
    }


    /**
     * Page de refus d'un paiment
     */
    #[Route('/offres/id/paiment/refus', name: 'app_front_offer_cancelCheckout', methods: ['GET'])]
    public function cancelCheckout(Offer $offer): Response
    {
        /**
         * @var Client
         */
        $client = $this->getUser();

        // on test si la commande m'appartient et aussi si la commande
        // est en status  "validé"
        if ($offer->getStatus() !== Offer::STATUS_VALIDATED || !$client->getOffers()->contains($offer)) {
            throw new NotFoundHttpException("L'offre n° {$offer->getId()} ne peut être payée");
        }

        // on affiche la page de refus
        return $this->render('front/offer/cancelCheckout.html.twig', [
            'offer' => $offer,
        ]);
    }
}
