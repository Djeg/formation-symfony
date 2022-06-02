# Exercice : CRUD des auteurs

Cette série d'éxercices nescessite des prérequis :

1. Configurer votre base de données dans le fichier `.env` en
   éditant la valeur `DATABASE_URL`. Choisir, MySQL, votre
   nom d'utilisateur (généralement `root`), votre mot de passe
   si vous possédez un mot de passe et spécifié le nom
   de la base de données.

    exémple :

    ```
                      username  password           nom de la base
                           |    |                        |
    DATABASE_URL="mysql://root:root@127.0.0.1:5050/formation-sf6"
    ```

2. Créez votre base de données en utilisant la commande symfony :

```
symfony console doctrine:database:create
```

## Générer l'entité et le repository "Author"

Graçe à la commande symfony :

```
symfony console make:entity
```

Générer un entité "Author" avec les champs suivant :

| nom         | type   | taille | null |
| ----------- | ------ | ------ | ---- |
| name        | string | 255    | no   |
| description | text   | -      | yes  |
| imageUrl    | string | 255    | yes  |

Mettre à jour la base de données avec la commande :

```
symfony console doctrine:schema:update --force
```

## Créer le AuthorController

Dans le dossier `src/Controller/Admin` créer un controller : `AuthorController` qui hérite
de `AbstractController`

## Créer un nouvel auteur

Dans le `AuthorController` ajouter une méthode `create` qui accèpte
2 paramètre « injécté » :

-   `Request $request`
-   `AuthorRepository $repository`

Ajouter une route `/admin/auteurs/nouveau` à ce controller (en suivant
les conventions de nommage des routes)

Dans le controller afficher un template html twig en suivant
les conventions de nommage. Ce template doit contenir
un formulaire HTML en méthode "POST" avec les champs suivant :

| nom du champ | type d'input |
| ------------ | ------------ |
| name         | text         |
| description  | textarea     |
| imageUrl     | text         |

Graçe aux instructions suivantes :

-   `$request->isMethod('POST')`
-   `$repository->add($author, true)`

Faire en sorte que lorsque le formulaire est soumis, un nouvel auteur
est enregistré en base de données.

> Vous pouvez vous aider du controller [`BookController`](../src/Controller/ExoBook/BookController.php)

## Lister les auteurs

Dans le `AuthorController` ajouter une méthode `list` qui accépte 1 paramètre
« injécté » :

-   `AuthorRepository $repository`

Ajouter une route `/admin/auteurs` à ce controller (en suivant
les conventions de nommage des routes)

Dans le controller afficher un template html twig en suivant
les conventions de nommage. Ce template doit contenir la liste
de tout les auteurs avec leurs :

-   name

Modifier la méthode `AuthorController::create`; lors de la création
d'un auteur rediriger sur la liste des auteurs en utilisant : `$this->redirectToRoute`

Vous pouvez ajouter un lien dans la page html de la liste
vers la création d'un nouvel auteur !

## Mettre à jour un auteur

Dans le `AuthorController` ajouter une méthode `update` qui accèpte
2 paramètre « injécté » et 1 paramètre de route :

-   `Request $request`
-   `AuthorRepository $repository`
-   `int $id`

Ajouter une route `/admin/auteurs/{id}` à ce controller (en suivant
les conventions de nommage des routes)

Dans le controller afficher un template html twig en suivant
les conventions de nommage. Ce template doit contenir
un formulaire HTML en méthode "POST" avec les champs suivant :

| nom du champ | type d'input |
| ------------ | ------------ |
| name         | text         |
| description  | textarea     |
| imageUrl     | text         |

Graçe à la commande `$repository->find($id)`, faire en sorte de préremplir
les champs de formulaire avec celui de l'auteur que l'on souhaite éditer

Graçe aux instructions suivantes :

-   `$request->isMethod('POST')`
-   `$repository->add($author, true)`

Faire en sorte que lorsque le formulaire est soumis, l'auteur
est mis à jour et rediriger vers la page de liste si tout ce
passe bien.

## Supprimer un auteur

Dans le `AuthorController` ajouter une méthode `delete` qui accèpte
1 paramètre « injécté » et 1 paramètre de route :

-   `int $id`
-   `AuthorRepository $repository`

Ajouter une route `/admin/auteurs/{id}/supprimer` à ce controller (en suivant
les conventions de nommage des routes)

Graçe aux instructions suivantes :

-   `$repository->find($id)`
-   `$repository->remove($author, true)`

Faire en sorte de supprimer l'auteur de la base de données et rediriger
vers la page de liste des auteurs
