# Formation Symfony 6 - Initiation

## Installer l'application

1. [Télécharger le code](https://github.com/Djeg/formation-symfony/archive/refs/heads/session/30.05.22-03.06.22.zip)
2. Ouvir le code extrait avec VSCode
3. Configurer votre base de données dans le fichier `.env`
4. Installer symfony : `symfony composer install`
5. Mettre en place la bdd :

```
symfony console doctrine:database:create
symfony console d:s:u --force
```

## Les exercices

-   [CRUD des livres](./exos/crud-book.md)
-   [CRUD des auteurs](./exos/crud-author.md)
-   [CRUD des catégories](./exos/crud-category.md)
-   [Formulaire pour les auteurs](./exos/form-author.md)
-   [Formulaire pour les livres](./exos/form-book.md)
-   [Maison d'éditions](./exos/publisher.md)
-   [Page d'accueil de notre site](./exos/home.md)
-   [Page de catégorie !](./exos/category.md)
-   [Page de recherche de livre](./exos/search.md)
-   [Page de recherche des catégories](./exos/search-categories.md)
