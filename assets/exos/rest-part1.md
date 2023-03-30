# Les API Rest - Partie 1

L'objectif de cet première partie d'exos, c'est de créer une api rest de « lécture » pour nos différentes entités !

## Lire et interoger des utilisateurs

Tou d'abord, généré un controlleur nommé `ApiUserController`.

Dans ce controller ajouter une route et une méthode :

`GET /api/users (Collection d'utilisateur)`

L'objectif de cette méthode est très simple, retourner tout les utilisateurs de la base de données !

> **BONUS** : Faire en sorte d'ignorer le mot de passe (password) dans la réponse JSON

Ensuite ajouter une seconde méthode :

`GET /api/users/{id} (Resource d'un utilisateur)`

L'objectif de cette méthode est très simple, retourner l'utilisateur correspondant à l'identifiant passé en paramètre de Route.

## Faire la même chose ...

Répéter les mêmes opérations pour :

- Les auteurs
- Les maisons d'éditions
- Les livres

> **AIDE** : Aidez-vous du fichier `request.http` afin de tester votre API !

> **ATTENTION** : Il faudra éviter les « circular reference »
