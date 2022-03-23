# Le Query Builder - Les requêtes à la base de données

En vous aidant du fichier `BookRepository` et de la méthode
`findExample`, réaliser les exercices suivant:

## Faire une page d'accueil

Dans un controller `BookController` ajouter une méthode `home` avec la
route suivante : `/`.

Dans ce controller, utiliser le `BookRepository` pour retourner
les 5 derniers livres de la base de données.

Afficher ces livres dans un template twig.

## Faire une page pour les livres les moins chers

Dans un controller `BookController` ajouter un méthode `sheap` avec
la route suivante : `/les-moins-chers`.

Dans ce controller, utiliser le `BookRepository` pour retourner
les 5 derniers livres ordonées par prix croissant.

Afficher ces livres dans un template twig.

## Faire une page pour les livres d'un auteur

Dans un controller `BookController` ajouter un méthode `author` avec
la route suivante : `/{id}/livres` (l'identifiant doit être celui d'un auteur).

Dans ce controller, utiliser le `BookRepository` pour retourner
les 10 derniers livres de l'auteur reçu en paramètre.

Afficher ces livres dans un template twig.

## Faire une page pour les livres avec les titre données

Dans un controller `BookController` ajouter un méthode `titleSearch` avec
la route suivante : `/rechercher/{title}` (le title doit être un chaine de character).

Dans ce controller, utiliser le `BookRepository` pour retourner
les 10 derniers livres qui contiennent dans leurs titre le paramètre `title`.

Afficher ces livres dans un template twig.

## Faire une page de recherche simple

Dans un controller `BookController` ajouter un méthode `search` avec
la route suivante : `/rechercher`.

Cette route peut accèpter les `query string` suivantes :

| nom   | example     | fonctionement                                             |
| ----- | ----------- | --------------------------------------------------------- |
| titre | ?titre=Harr | Recherche tout les livres contenant Harr dans leurs titre |
| limit | ?limite=5   | Limite les livres à 5 résultats                           |
| page  | ?page=2     | Sort la page n°2                                          |

Dans ce controller, utiliser le `BookRepository` pour retourner
le résultat de la recherche.

Afficher ces livres dans un template twig.
