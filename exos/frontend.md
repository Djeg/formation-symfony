# Le Frontend

Dans cette partie, l'objéctif est de créer la partie public d'un site
internet (frontend).

> **Attention** : Les controller, form, DTO doivent être rangé
> dans leur répertoire "Front". Donc créer un dossier Front
> dans le répertoire DTO, puis Controller, puis Form.

## Page d'accueil

Dans un controller `HomeController` ajouter une méthode `home` avec
la route suivante: `/` qui affiche une page d'accueil.

Cette page d'accueil doit contenir:

- Un "header" avec un menu (accès à la page d'accueil)
- Les 10 derniers livres à vendre
- Les 5 derniers auteurs
- Les 10 dernières catégories
- Un footer

## Afficher un livre

Dans un controller `BookController` ajouter une méthode `show`
avec la route `/livres/{id}` qui affiche les détail du livre:

- Son Titre
- Son auteur
- Son prix
- Sa description

Cette page doit reprendre le menu et le footer de la page d'accueil.

Lors du clique sur un livre dans la page d'accueil, rediriger
vers cette page.

## Afficher un auteur

Dans un controller `AuthorController` ajouter une méthode `show`
avec la route : `/auteurs/{id}` qui affiche les détail d'un auteur:

- Son nom
- Sa description
- Ses 10 derniers livres à vendre

Cette page doit reprendre le menu et le footer de la page d'accueil.

Lors du clique sur un auteur dans la page d'accueil, rediriger
vers cette page.

## Moteur de recherche

Dans un controller `BookController` ajouter une méthode `search`
avec la route : `/rechercher`.

Cette page doit contenir le formulaire recherche suivant :

| nom          | type         | Valeur par défaut |
| ------------ | ------------ | ----------------- |
| limit        | IntegerType  | 25                |
| page         | IntergerType | 1                 |
| sortBy       | ChoiceType   | 'id'              |
| direction    | ChoiceType   | 'DESC'            |
| title        | TextType     | null              |
| authorName   | TextType     | null              |
| categoryName | TextType     | null              |
| minPrice     | NumberType   | null              |
| maxPrice     | NumberType   | null              |

Lors de la soumission du formulaire retourner les livres correspondant
à la recherche.

Cette page doit reprendre le menu et le footer de la page d'accueil.

Ajouter dans le menu un lien vers cette page

Dans cette page, si je clique sur un livres je doit être rediriger
vers `/livres/{id}`.

## Clique sur une catégorie

Lorsque je clique sur une categorie dans la page d'accueil je doit
être rediriger vers : `/rechercher` avec la query correspondant
au nom de la category.
