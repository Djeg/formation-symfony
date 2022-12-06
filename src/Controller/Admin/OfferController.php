<?php

namespace App\Controller\Admin;

use App\Entity\Offer;
use App\Repository\OfferRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ce controller s'occupe de la partie gestion des offres de l'administration.
 * Il est uniquement accessible aux client avec le ROLE_ADMIN
 */
#[IsGranted('ROLE_ADMIN')]
class OfferController extends AbstractController
{
    /**
     * Liste les offres en attente de gestion
     */
    #[Route('/admin/offres', name: 'app_admin_offer_list', methods: ['GET'])]
    public function list(OfferRepository $repository): Response
    {
        // Récupération des offres
        $offers = $repository->findBy([
            'status' => Offer::STATUS_WAITING,
        ], ['updatedAt' => 'ASC']);

        // Affichage de la liste des offres à valider
        return $this->render('admin/offer/list.html.twig', [
            'offers' => $offers,
        ]);
    }

    /**
     * Valide un offre en attent
     */
    #[Route('/admin/offres/{id}/validation', name: 'app_admin_offer_validate', methods: ['GET'])]
    public function validate(Offer $offer, OfferRepository $repository): Response
    {
        // on test si l'offre n'est pas dèja validé
        if ($offer->getStatus() !== Offer::STATUS_WAITING) {
            throw new NotFoundHttpException("L'offre {$offer->getId()} ne peus être validé");
        }

        // On valide l'offre et on calcule les frais d'agence
        $offer
            ->setStatus(Offer::STATUS_VALIDATED)
            ->setAgencyFee(round($offer->getPrice() * (Offer::AGENCY_FEE_PERCENT / 100)));

        // on sauvegarde l'offre
        $repository->save($offer, true);

        // On retourne sur la liste des offres
        return $this->redirectToRoute('app_admin_offer_list');
    }

    /**
     * Refuse une offre en attente
     */
    #[Route('/admin/offres/{id}/refuser', name: 'app_admin_offer_denied', methods: ['GET'])]
    public function denied(Offer $offer, OfferRepository $repository): Response
    {
        // on test si l'offre n'est pas dèja validé
        if ($offer->getStatus() !== Offer::STATUS_WAITING) {
            throw new NotFoundHttpException("L'offre {$offer->getId()} ne peus être refusé");
        }

        // On refuse l'offre
        $offer->setStatus(Offer::STATUS_DENIED);

        // on sauvegarde l'offre
        $repository->save($offer, true);

        // on retourne sur la liste des offres
        return $this->redirectToRoute('app_admin_offer_list');
    }
}
