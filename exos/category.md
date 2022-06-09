# La page de catégories

Vous pouvez aider de l'example suivant dans le [BookRepository](../src/Repository/BookRepository.php#L42)

## Création de la page d'une catégorie

Ajouter un controller `CategoryController` dans le dossier `Front`.

Créer une méthode "display" avec la route suivante : `/categorie/{id}`.

Dans ce controller, récupérer tout les livres de la catégorie ciblé
trié par prix décroissant :

> Afin de vous aider, vous devrez utilisez `leftJoin` dans le query builder
> du BookRepository :
>
> ```php
> $qb->leftJoin('book.categories', 'category')->andWhere('category.title = "test"')
> ```

Afficher les livres dans un template twig en suivant les conventions de nommage

**BONUS** : Faire en sorte de pouvoir cliquer sur une catégorie d'un livre de
la page d'accueil afin de se rendre sur la page d'une catégorie.
