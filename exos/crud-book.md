# Exercice : CRUD de livres

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
    DATABASE_URL="mysql://root:root@127.0.0.1:3306/formation-sf6"
    ```

2. Créez votre base de données en utilisant la commande symfony :

```
symfony console doctrine:database:create
```

## Générer l'entité et le repository "Book"

Graçe à la commande symfony :

```
symfony console make:entity
```

Générer un entité "Book" avec les champs suivant :

| nom         | type   | taille | null |
| ----------- | ------ | ------ | ---- |
| title       | string | 255    | no   |
| price       | float  | -      | no   |
| description | text   | -      | yes  |
| imageUrl    | string | 255    | yes  |

Mettre à jour la base de données avec la commande :

```
symfony console doctrine:schema:update --force
```

## Créer le BookController

Dans le dossier `src/Controller` ajouter un dossier `Admin`,
à l'intérieur créer un controller : `BookController` qui hérite
de `AbstractController`

## Créer un nouveau livre

Dans le `BookController` ajouter une méthode `create` qui accèpte
2 paramètre « injécté » :

-   `Request $request`
-   `BookRepository $repository`

Ajouter une route `/admin/livres/nouveau` à ce controller (en suivant
les conventions de nommage des routes)

Dans le controller afficher un template html twig en suivant
les conventions de nommage. Ce template doit contenir
un formulaire HTML en méthode "POST" avec les champs suivant :

| nom du champ | type d'input |
| ------------ | ------------ |
| title        | text         |
| price        | money        |
| description  | textarea     |
| imageUrl     | text         |

Graçe aux instructions suivantes :

-   `$request->isMethod('POST')`
-   `$repository->add($book, true)`

Faire en sorte que lorsque le formulaire est soumis, un nouveau livre
est enregistré en base de données.

> Vous pouvez vous aider du controller [`BookController`](../src/Controller/ExoBook/BookController.php)

## Lister les livres

Dans le `BookController` ajouter une méthode `list` qui accépte
1 paramètre « injécté » :

-   `BookRepository $repository`

Ajouter une route `/admin/livres` à ce controller (en suivant
les conventions de nommage des routes)

Dans le controller afficher un template html twig en suivant
les conventions de nommage. Ce template doit contenir la liste
de tout les livres avec leurs :

-   title
-   price
-   imageUrl (si présent)

Modifier la méthode `BookController::create`; lors de la création
d'un livre rediriger sur la liste des livres en utilisant : `$this->redirectToRoute`

Vous pouvez ajouter un lien dans la page html de la liste
vers la création d'un nouveau livre !

## Mettre à jour un livre

Dans le `BookController` ajouter une méthode `update` qui accèpte
2 paramètre « injécté » et 1 paramètre de route :

-   `Request $request`
-   `BookRepository $repository`
-   `int $id`

Ajouter une route `/admin/livres/{id}` à ce controller (en suivant
les conventions de nommage des routes)

Dans le controller afficher un template html twig en suivant
les conventions de nommage. Ce template doit contenir
un formulaire HTML en méthode "POST" avec les champs suivant :

| nom du champ | type d'input |
| ------------ | ------------ |
| title        | text         |
| price        | money        |
| description  | textarea     |
| imageUrl     | text         |

Graçe à la commande `$repository->find($id)`, faire en sorte de préremplir
les champs de formulaire avec celui du livre que l'on souhaite éditer

Graçe aux instructions suivantes :

-   `$request->isMethod('POST')`
-   `$repository->add($book, true)`

Faire en sorte que lorsque le formulaire est soumis, le livre
est mis à jour et rediriger vers la page de liste si tout ce
passe bien.

## Supprimer un livre

Dans le `BookController` ajouter une méthode `delete` qui accèpte
1 paramètre « injécté » et 1 paramètre de route :

-   `int $id`
-   `BookRepository $repository`

Ajouter une route `/admin/livres/{id}/supprimer` à ce controller (en suivant
les conventions de nommage des routes)

Graçe aux instructions suivantes :

-   `$repository->find($id)`
-   `$repository->remove($book, true)`

Faire en sorte de supprimer le livre de la base de données et rediriger
vers la page de liste des livres
