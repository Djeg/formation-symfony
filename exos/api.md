# Les API REST

## Prérequis:

Afin de pouvoir comprendre le JSON, symfony à besoin
d'un bundle (plugin, extension ...). Ce bundle
permet à symfony de comprendre le JSON :

```
composer req symfony-bundles/json-request-bundle
```

Vous pouvez tester les routes de l'api en utilisant
le fichier : [request.http](../request.http)

## 1. La liste de tout les livres

Dans un controller : `API\BookController` ajouter
une méthode `list` avec la route suivante :

`GET /books`

En utilisant la méthode du controller `$this->json(...);`
ainsi que l'attribut PHP `#[Ignore()]` faire en sorte
de retourner tout les livres en JSON.

## 2. La liste de tout les auteurs

Dans un controller : `API\AuthorController` ajouter
une méthode `list` avec la route suivante :

`GET /authors`

En utilisant la méthode du controller `$this->json(...);`
ainsi que l'attribut PHP `#[Ignore()]` faire en sorte
de retourner tout les auteurs en JSON.

## 3. La liste de tout les catégories

Dans un controller : `API\CategoryController` ajouter
une méthode `list` avec la route suivante :

`GET /categories`

En utilisant la méthode du controller `$this->json(...);`
ainsi que l'attribut PHP `#[Ignore()]` faire en sorte
de retourner toutes les catégories en JSON.

## 4. Rechercher des livres

Créer un formulaire : `App\Form\API\ApiSearchBookType` attaché au DTO:
`App\DTO\BookSearch` (`symfony console make:form API\\ApiSearchBook`).

Graçe à la méthode [`getBlockPrefix`](../src/Form/API/ApiSearchBookType.php), supprimé
le prefix du formulaire.

Configure les options du formulaire dans la méthode [`configureOptions`](../src/Form/API/ApiSearchBookType.php).

Personaliser vos champs de formulaire.

Utiliser ce formulaire dans le controller `App\Controller\API\BookController::list`.

## 5. Recherche des auteurs

Créer un formulaire : `App\Form\API\ApiSearchAuthorType` attaché au DTO:
`App\DTO\AuthorSearch` (`symfony console make:form API\\ApiSearchAuthor`).

Graçe à la méthode [`getBlockPrefix`](../src/Form/API/ApiSearchBookType.php), supprimé
le prefix du formulaire.

Configure les options du formulaire dans la méthode [`configureOptions`](../src/Form/API/ApiSearchBookType.php).

Personaliser vos champs de formulaire.

Utiliser ce formulaire dans le controller `App\Controller\API\AuthorController::list`.

## 5. Recherche des catégories

Créer un formulaire : `App\Form\API\ApiSearchCategoryType` attaché au DTO:
`App\DTO\CategorySearch` (`symfony console make:form API\\ApiSearchCategory`).

Graçe à la méthode [`getBlockPrefix`](../src/Form/API/ApiSearchBookType.php), supprimé
le prefix du formulaire.

Configure les options du formulaire dans la méthode [`configureOptions`](../src/Form/API/ApiSearchBookType.php).

Personaliser vos champs de formulaire.

Utiliser ce formulaire dans le controller `App\Controller\API\CategoryController::list`.

## 6. La création d'un auteur

Créer un formulaire `App\Form\API\ApiAuthorType` attaché à l'entité
`Author`.

Dans ce formulaire, configuré le pour être un formulaire d'api
(vous pouvez vous inspirer du formulaire : [`ApiBookType`](../src/Form/API/ApiBookType.php)).

Ajouter dans le controller `App\Controller\Api\AuthorController` une methode "create"
avec la route :

```
POST /api/authors
```

Dans ce controller et graçe au formulaire créé plus haut, sauvegarder et
retourner un nouvel auteur (Vous pouvez vous inspirez de : [`BookController::create`](../src/Controller/API/BookController.php#L57)).

Vous pouvez tester en utilisant le fichier [`request.http`](../request.http).

## 6. La mise à jour d'un auteur

Ajouter dans le controller `App\Controller\Api\AuthorController` une methode "update"
avec la route :

```
PATCH /api/authors/{id}
```

Dans ce controller et graçe au formulaire créé plus haut, sauvegarder et
retourner l'auteur modifié (Vous pouvez vous inspirez de : [`BookController::update`](../src/Controller/API/BookController.php#L106)).

Vous pouvez tester en utilisant le fichier [`request.http`](../request.http).

## 7. La suppression d'un auteur

Ajouter dans le controller `App\Controller\Api\AuthorController` une methode "delete"
avec la route :

```
DELETE /api/authors/{id}
```

Dans ce controller supprimé et
retourner l'auteur (Vous pouvez vous inspirez de : [`BookController::delete`](../src/Controller/API/BookController.php#L155)).

Vous pouvez tester en utilisant le fichier [`request.http`](../request.http).

## 8. Créer, metre à jour et supprimer des catégories

En répétant les étapes concernant les auteurs faire la même
chose pour les catégories.
