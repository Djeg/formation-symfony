# Exercice : CRUD des catégories

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

## Générer l'entité et le repository "Category"

Graçe à la commande symfony :

```
symfony console make:entity
```

Générer un entité "Category" avec les champs suivant :

| nom  | type   | taille | null |
| ---- | ------ | ------ | ---- |
| name | string | 255    | no   |

Mettre à jour la base de données avec la commande :

```
symfony console doctrine:schema:update --force
```

## Créer le AuthorController

Dans le dossier `src/Controller/Admin` créer un controller : `CategoryController` qui hérite
de `AbstractController`

## Créer une nouvelle catégorie

Dans le `CategoryController` ajouter une méthode `create` qui accèpte
2 paramètre « injécté » :

-   `Request $request`
-   `CategoryRepository $repository`

Ajouter une route `/admin/categories/nouvelle` à ce controller (en suivant
les conventions de nommage des routes)

Dans le controller afficher un template html twig en suivant
les conventions de nommage. Ce template doit contenir
un formulaire HTML en méthode "POST" avec les champs suivant :

| nom du champ | type d'input |
| ------------ | ------------ |
| name         | text         |

Graçe aux instructions suivantes :

-   `$request->isMethod('POST')`
-   `$repository->add($category, true)`

Faire en sorte que lorsque le formulaire est soumis, une nouvelle catégorie
est enregistrée en base de données.

> Vous pouvez vous aider du controller [`BookController`](../src/Controller/ExoBook/BookController.php)

## Lister les catégories

Dans le `CategoryController` ajouter une méthode `list` qui accépte
1 paramètre « injécté » :

-   `CategoryRepository $repository`

Ajouter une route `/admin/categories` à ce controller (en suivant
les conventions de nommage des routes)

Dans le controller afficher un template html twig en suivant
les conventions de nommage. Ce template doit contenir la liste
de tout les auteurs avec leurs :

-   name

Modifier la méthode `CategoryController::create`; lors de la création
d'un auteur rediriger sur la liste des auteurs en utilisant : `$this->redirectToRoute`

Vous pouvez ajouter un lien dans la page html de la liste
vers la création d'une nouvelle catégorie !

## Mettre à jour une catégories

Dans le `CategoryController` ajouter une méthode `update` qui accèpte
2 paramètre « injécté » et 1 paramètre de route :

-   `Request $request`
-   `CategoryRepository $repository`
-   `int $id`

Ajouter une route `/admin/categories/{id}` à ce controller (en suivant
les conventions de nommage des routes)

Dans le controller afficher un template html twig en suivant
les conventions de nommage. Ce template doit contenir
un formulaire HTML en méthode "POST" avec les champs suivant :

| nom du champ | type d'input |
| ------------ | ------------ |
| name         | text         |

Graçe à la commande `$repository->find($id)`, faire en sorte de préremplir
les champs de formulaire avec celui de la catégorie que l'on souhaite éditer

Graçe aux instructions suivantes :

-   `$request->isMethod('POST')`
-   `$repository->add($category, true)`

Faire en sorte que lorsque le formulaire est soumis, la catégorie
est mise à jour et rediriger vers la page de liste si tout ce
passe bien.

## Supprimer une catégorie

Dans le `CategoryController` ajouter une méthode `delete` qui accèpte
1 paramètre « injécté » et 1 paramètre de route :

-   `int $id`
-   `CategoryRepository $repository`

Ajouter une route `/admin/categories/{id}/supprimer` à ce controller (en suivant
les conventions de nommage des routes)

Graçe aux instructions suivantes :

-   `$repository->find($id)`
-   `$repository->remove($category, true)`

Faire en sorte de supprimer la category de la base de données et rediriger
vers la page de liste des catégories
