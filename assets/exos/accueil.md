# La page d'accueil

L'objectif de cet exercice est de réaliser une page d'accueil « optimisé ».

## 1. Créer le méthode `findLatest` dans le `BookRepository`

Dans le `BookRepository`, ajouter une méthode `findLatest` qui retourne les 25 derniers livres trier par date de mise à jour décroissante !

## 2. Créer la méthode `findLatest` dans le `AuthorRepository`

Dans le `AuthorRepository`, ajouter une méthode `findLatest` qui retourne les 10 derniers auteurs trier par date de mise à jour décroissante !

## 3. Créer la méthode `findLatest` dans le `PublishingHouseRepository`

Dans le `PublishingHouseRepository`, ajouter une méthode `findLatest` qui retourne les 5 dernières maisons d'édition triéé par date de mise à jour décroissante.

## 4. Générer le `HomeController` !

Avec la commande `symfony console make:controller` générer un controlleur `HomeController`.

## 5. La page d'accueil

Dans le `HomeController` ajouter une page d'accueil, (`home`) qui liste les 25 derniers livres, les 10 derniers auteurs ainsi que les 5 dernières maisons d'édition.
