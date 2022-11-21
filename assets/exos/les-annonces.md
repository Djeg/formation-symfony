# Les Annonces

L'objectif de cet exercice c'est de créer un page d'accueil affichant les 10 dernières annonces !

## Générer Entity / Repository

Nous allons générer une entité : « Ad » (annonce de vente). Cette entité posséde les champs suivant :

| nom       | type     | requis |
| --------- | -------- | ------ |
| book      | relation | oui    |
| title     | string   | non    |
| author    | relation | oui    |
| price     | float    | oui    |
| createdAt | datetime | oui    |
| updatedAt | datetime | oui    |

## Les fixtures

En vous aidant du supports, créer 2 annonces « fixes » ainsi qu'une 20aine d'annonces aléatoire.

## Le controller & La Vue

Généré un controller « HomeController » qui possède un méthode : « home » avec la route : "/"

Ce controller doit utiliser le bon repository afin de récupérer les 10 derniers livres de la base de données (**findBy**).

Créer un template twig pour affiche ces 10 articles. Attention ce template twig ne doit pas utiliser la même base, et
le même design que l'administration.
