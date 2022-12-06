# Gestion administrative des offres

L'objectif de cette fonctionnalité est d'offrir une page réserver aux administreur afin de pouvoir valider ou refuser des offres !

## Etape 1 - Le Controller, la liste des offres

Commencer par créer un controller dédié aux administrateur `Admin\OfferController`. Dans ce controller
ajouter une méthode et une route (`/admin/gestion`) qui affiche tout les offres avec le status "en attente" !

Ces offres possède 2 boutons : "valider" et "refuser".

> Attention ce controller doit-être réservé aux utilisateurs avec le ROLE_ADMIN !

## Etape 2 - Valider une offre

Créer uné méthode dans le controller `Admin\OfferController` avec une route (`/admin/{id}/valider`). Le but de se controller est de changé le status d'une offre "en attente" à "validé" et rediriger vers la liste des offres.

## Etape 3 - Refuser une offre

Créer une méthode dans le controller `Admin\OfferController` avec une route (`/admin/{id}/refuser`). Le but de se controller est de changé le status d'une offre "en attente" à "refusé" et rediriger vers la liste des offres.
