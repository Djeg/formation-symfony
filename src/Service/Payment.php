<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Account;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Contient toute la logique de notre système de paiement.
 */
class Payment
{
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * Créer, grâce à stripe, une url de « checkout » permettant de rediriger
     * l'utilisteur vers le paiement stripe.
     */
    public function checkout(Account $account): string
    {
        // Contient les items (produits) stripe
        $lineItems = [];

        // On se connécte à Stripe
        Stripe::setApiKey('sk_test_bxRlPNBMpA5734i4hzBc0sIA');

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
            'success_url' => $this->router->generate('app_cart_confirm', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->router->generate('app_cart_error', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return $checkout->url;
    }
}
