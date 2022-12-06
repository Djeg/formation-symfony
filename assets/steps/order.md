# Faire une commande

L'objéctif de cette partie est de données la possibilité à un client de faire une offre sur un bien immobilier !

## Etape 1 - Le formulaire

Créer un formulaire qui remplie l'entité `Offer` avec les champs suivant :

| nom     | description                                                                                  |
| ------- | -------------------------------------------------------------------------------------------- |
| price   | Contient le prix de l'offre souhaité                                                         |
| message | Contient un textarea avec un message optionel sur l'offre                                    |
| cash    | contient "oui" ou "non". Cela permet de savoir si le financement d'un client est cash ou non |

## Etape 2 - Le controller

Créer un controller `Front\OfferController`, lui ajouté une méthode `make` (avec la route : `/{id-du-bien-immobilier}/faire-une-offre`).

En utilisant le formulaire créé précédement et le bien immobilier, afficher les informations du bien ainsi que le formulaire pour créer une offre.

Si l'offre est valide, alors rediriger le client vers une page de confirmation lui expliquant que l'offre sera analyser le plus vite possible.

> Attention, ce controller n'est accessible qu'au client connécté !
