<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\Ad;
use App\Repository\AdRepository;
use App\Repository\CartRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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

    /**
     * Valide un paiement et redirige sur stripe
     */
    #[Route('/mon-panier/validation', name: 'app_cart_validate', methods: ['GET'])]
    public function validate(): Response
    {
        // Contient les items (produits) stripe
        $lineItems = [];

        // On se connécte à Stripe
        Stripe::setApiKey('sk_test_bxRlPNBMpA5734i4hzBc0sIA');

        /**
         * @var Account
         */
        $account = $this->getUser();

        // Je boucle sur toutes les annonces du panier de l'utilisateur
        foreach ($account->getCart()->getAds() as $ad) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'EUR',
                    'product_data' => [
                        'name' => "{$ad->getTitle()}-{$ad->getId()}"
                    ],
                    'unit_amount' => (int)$ad->getPrice() * 100,
                ],
                'quantity' => 1,
            ];
        }

        // Créer l'url de paiment stripe
        $checkout = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => $this->generateUrl('app_cart_confirm', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('app_cart_error', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        // On redirige vers l'url stripe
        return $this->redirect($checkout->url);
    }

    /**
     * Page de confirmation d'un paiement (tout c'est passé)
     */
    #[Route('/mon-panier/confirmation', name: 'app_cart_confirm', methods: ['GET'])]
    public function confirm(CartRepository $cartRepository, AdRepository $adRepository): Response
    {
        /**
         * @var Account
         */
        $account = $this->getUser();

        // je supprime les annonces du panier et de la base de données
        foreach ($account->getCart()->getAds() as $ad) {
            $adRepository->remove($ad);
            $account->getCart()->removeAd($ad);
        }

        // je sauvegarde le panier
        $cartRepository->save($account->getCart(), true);

        return $this->render('cart/confirm.html.twig');
    }

    /**
     * page d'erreur de paiement
     */
    #[Route('/mon-panier/paiement-error', name: 'app_cart_error', methods: ['GET'])]
    public function error(): Response
    {
        return $this->render('cart/error.html.twig');
    }
}
