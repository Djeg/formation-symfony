# Terminer une offre

L'objectif de cette fonctionnalité est de permettre à un client de payer les frais d'agence (3% du prix de la demande) afin de terminer son offre !

pour cela il vous faudra utiliser Stripe ainsi que 3 routes différente :

- Une route pour générer et rediriger vers l'url de paiement stripe
- Une route qui sera utilisé par stripe lorsque tout c'est bien passé
- Une route qui sera utilisé par stripe lorsque le paiement n'est pas possible

## Etape 1 - Générer l'url de paiement

Dans le controller `Front\OfferController` ajouter uné méthode avec une route (`/offres/{id}/paiement`). Le but de cette méthode est d'utiliser Stripe afin de générer une URL de paiment valide pour cette offre. Le montant à régler sera 3% du prix de l'offre !

## Etape 2 - Attacher l'url de success

Dans le controller `Front\OfferController` ajouter une méthode avec une route (`/offres/{id}/validation`). Le but de cette méthode est d'afficher une page twig de confirmation, cela permettra de confirmer le paiement et l'offre doit passer au status "terminé".

> Attention : veillez à bien attaché l'url de succes à stripe lors de l'appel du « checkout »

## Etape 3 - Attacher l'url d'echec

Dans le controller `Front\OfferController` ajouter une méthode avec une route (`/offres/{id}/validation`). Le but de cette méthode est d'afficher une page twig d'echec et d'inviter le client a réessayer plus tard

> Vous retrouverez la documentation compléte de stripe [juste ici](https://stripe.com/docs/checkout/quickstart?lang=php)
