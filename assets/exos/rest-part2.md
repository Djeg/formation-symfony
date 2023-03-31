# Les API Rest - Partie 2

L'objectif de cet exercice est de terminer notre api rest en offrant la possibilité de recherche, créer, éditer et supprimer des données de notre api !

> **IMPORTANT** : A chaque étapes n'hésitez pas à tester votre api avec le fichier `request.http`. Vous pouvez aussi cliquer sur le `X-Debug-Token-Link` afin de débuguer votre application Symfony.

## Les auteurs

### La recherche des auteurs

Dans le controller `ApiAuthorController` et dans la méthode `list`, faire en sorte d'utiliser une formulaire de recherche afin de pouvoir filtrer les auteurs dans notre requête !

### La création d'un auteur

Dans le controller `ApiAuthorController` créer une méthode `create` (avec l'url : `POST /api/authors`). Utiliser un formulaire d'api avec la bonne configuration, et enregistré l'auteur dans la base de données

> Attention à bien gérer les erreurs

### Éditer un auteur

Dans le controller `ApiAuthorController` créer une méthode `edit` (avec l'url : `PATCH /api/authors/{id}`). Utiliser un formulaire d'api afin d'éditer les informations d'un auteur

### Supprimer un auteur

Dans le controller `ApiAuthorController` créer une méthode `remove` (avec l'url : `DELETE /api/authors/{id}`). Supprimer l'auteur de la base de données :)

## Le reste ...

En suivant les mêmes étapes que plus haut, réaliser les routes suivante :

```
GET /api/publishing-houses # Liste les maisons d'édition, avec un formulaire de recherche
GET /api/publishing-houses/{id} # Affiche une maisons d'édition
POST /api/publishing-houses # Création d'une maison d'édition
PATCH /api/publishing-houses/{id} # Met à jour une maisons d'édition
DELETE /api/publishing-houses/{id} # Supprime une maison d'édition
```

```
GET /api/books # Liste les livres, avec un formulaire de recherche
GET /api/books/{id} # Affiche un livres
POST /api/books # Création d'un livre
PATCH /api/books/{id} # Met à jour un livre
DELETE /api/books/{id} # Supprime un livre
```
