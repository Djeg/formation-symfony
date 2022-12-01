# Les Services & Le Container

Symfony utilise un patron de conception (design pattern) très célébre : **IOC** (L'inversion de contrôle, L'injection de dépendance).

Le principe est d'avoir un méga container contenant **toutes les instances d'objet** pouvant être utilisé dans l'application.

## Afficher le contenu du container

Il est possible d'utiliser la commande symfoyn afin d'afficher **tout ce que contient** le container :

```bash
# sans docker
symfony console debug:container
# avec docker
bin/sf console de:cont
```

Vous pouvez utiliser la commande linux : **grep** afin de faire une recherche intéligente :

```bash
# sans docker
symfony console debug:container | grep Repository
# avec docker
bin/sf console de:cont | grep Repository
```

> Il éxiste la même commande pour afficher les routes de l'application : `symfony console debug:router`

## Créer ses propres services

Symfony et son container vont automatiquement ajouter dans le container toutes les classes contenue dans votre application (le dossier `src`).

Ainsi, vous pouvez très facilement créé vos propres classes qui contient le code de vtre choix. En effet, programmer en orienté objet c'est donné la possibilité au programmeur de « cloisoner », « représenter », « modéliser » un problème dans un objet.

Par éxemple, nous pourrions représenter dans un objet notre système de paiement !

Immaginons une classe `Payment` avec une méthode `checkout`, cette méthode utilise stripe et retourne l'url de checkout.

```php
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

    /**
     * Ici, nous demandons à symfony de nous « injecter » (c'est comme ce qu'il se passe
     * dans un controller) un objet d'instance RouterInterface
     */
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
```

L'exemple plus haut, montre la création d'un « Service ». C'est une classe personnalisé qui, grâce au container symfony, peut se voir injécter d'autre services dans ses paramètres de constructeur.

Symfony se charge alors de le créé pour vous :

```php
/**
 * Valide un paiement et redirige sur stripe
 */
#[Route('/mon-panier/validation', name: 'app_cart_validate', methods: ['GET'])]
public function validate(Payment $payment): Response
{
    // On redirige vers l'url stripe
    return $this->redirect($payment->checkout($this->getUser()));
}
```
