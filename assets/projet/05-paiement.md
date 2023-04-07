# Payer avec stripe

Tout d'abord commencer par créer un compte sur [stripe.com](https://stripe.com/en-fr).

## Récupérer la clefs de connection

Afin d'utiliser stripe dans notre code PHP, il nous faut la clef de connexion. Pour cela, rendez-vous sur votre dashboard, cliquez sur « developper » puis « api keys » et ensuite copier la « publishable key ».

## Installer stripe

Pour installer stripe en PHP il faut utiliser composer :

```
symfony composer require stripe/stripe-php
```

## Le controller de paiment

Dans le `BasketController` ajouter une méthode `pay` (`/mon-panier/payer`).

Dans cette méthode il faudra utiliser stripe de la manière suivante :

```php
// Création d'un « client » stripe
$stripe = new StripeClient('.... la clefs de connexion ...')

// Il vous faudra récupérer touts les livres du panier
// et passer l'instruction suivante :

$checkout = $stripe->checkout->sessions->create([
  // On spécifie que l'on veut un paiement
  'mode' => 'payment',
  // On spécifie une url, vers laquel l'utilisateur sera redirigé si tout ce passe bien !
  // C'est la page vers laquel l'utilisateur sera redirigé
  'success_url' => $this->generateUrl('app_basket_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
  // On spécifié l'url vers laquel l'utilisateur sera redirigé pour tout défaut de paiment !
  'cancel_url' => $this->generateUrl('app_basket_error', [], UrlGeneratorInterface::ABSOLUTE_URL),
  // Il faut spécifier les articles que l'utilisateur achéte
  'line_items' => [
    // Chaque article, est un tableaux :
    [
      // On spécifie la quantité
      'quantity' => 1,
      'price_data' => [
        // La monaie
        'currency' => 'eur',
        'product_data' => [
          'name' => 'Ici se trouve le nom du livre',
        ],
        // Prix du livre en centime !
        'unit_amount' => 890,
      ]
    ]
  ]
])


// pour terminer il faut rediriger vers la page de paiment :
return new RedirectResponse($checkout->url);
```

> Il vous faudra aussi créer une page de succèss et une page d'erreur pour le paiment toujours dans le `BasketController`

## Ajouter le lien de paiment :

Dans la page du panier ajouter le lien vers la page de paiment

> **Vous pouvez utiliser la carte numéro : 4242 4242 4242 4242 pour simuler un vrai paiement !**
