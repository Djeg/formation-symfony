<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\Ad;
use App\Repository\CartRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Contient toutes les pages concernant le panier
 */
#[IsGranted('ROLE_USER')]
class CartController extends AbstractController
{
    /**
     * Ajoute une annonce dans la panier de l'utilisateur connécté
     */
    #[Route('/mon-panier/{id}/ajouter', name: 'app_cart_add', methods: ['GET'])]
    public function add(Ad $ad, CartRepository $repository): Response
    {
        /**
         * @var Account
         */
        $account = $this->getUser();

        // je récupére le panier de l'utilisateur connécté
        $cart = $account->getCart();

        // j'ajoute l'annonce dans le panier
        $cart->addAd($ad);

        // j'enregistre le panier
        $repository->save($cart, true);

        // Je redirige vers la page du panier
        return $this->redirectToRoute('app_cart_show');
    }

    /**
     * Suppression d'une annonce du panier
     */
    #[Route('/mon-panier/{id}/supprimer', name: 'app_cart_remove', methods: ['GET'])]
    public function remove(Ad $ad, CartRepository $repository): Response
    {
        /**
         * @var Account
         */
        $account = $this->getUser();

        // je récupére le panier de l'utilisateur connécté
        $cart = $account->getCart();

        // je supprime l'annonce dans le panier
        $cart->removeAd($ad);

        // j'enregistre le panier
        $repository->save($cart, true);

        // Je redirige vers la page du panier
        return $this->redirectToRoute('app_cart_show');
    }

    /**
     * Affiche le contenue du panier
     */
    #[Route('/mon-panier', name: 'app_cart_show', methods: ['GET'])]
    public function show(): Response
    {
        // on affiche la page
        return $this->render('cart/show.html.twig');
    }
}
