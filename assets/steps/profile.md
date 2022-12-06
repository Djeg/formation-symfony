# Le Profil

L'objéctif de cette partie est de créer la page de profile d'un client. Cette page doit contenir un formulaire d'édition des informations personnel et un listing des offres du client.

## Etape 1 - Entité

À l'aide du [schèma d'entité](../images/uml-bdd.png), créé une entité `Offer` en respectant les champs spécifier dans le schèma et ajouter les bonnes relations.

> Note : Le champs status contient le status de l'offre, ils sont au nombre de 4 :
>
> - en cours
> - validé
> - refusé
> - terminé

## Etape 2 - Les fixtures

Ajouter dans le fichier de fixtures `fixtures/data.yml`, environ une 5 offres par client présent sur l'application attaché bien sur, à des biens immobilier.

## Etape 3 - Le Controller

Dans le controller `Front\ClientController` et ajouter une route avec une méthode (`/mon-profil`). Utiliser le formulaire d'inscription pour modifier les données personnel d'un client, et, récupérer les offres du client et les afficher dans un template twig.

> Vous pouvez aussi mettre à jour le menu, lorsqu'un client est connécté à l'application, alors le menu doit afficher "mon profil" plutôt que "connexion" :)
