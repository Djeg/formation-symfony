# Api pour les auteurs

## Création du controller

Créer un controller `App\Controller\API\AuthorController`. Ajouter à ce controller
la route `/api/authors`

## Préparation de l'entité

Ajouter l'attribut `#[Ignore]` au champ `books` de l'entité `Author`.

## Création du formulaire des auteurs

Dans le répertoire `App\Form\API` ajouter une class `ApiAuthorType` qui hérite
de la class `AdminAuthorType` et qui désactive la protection CSRF ainsi
que le prefix.

> Vous pouvez vous inspirer du formulare [`App\Form\API\ApiRegistrationType`](../src/Form/API/ApiRegistrationType.php)

## Création du formulaire de recherche des auteurs

Dans le répertoire `App\Form\API` ajouter une class `ApiSearchAuthorType` qui hérite
de la class `SearchAuthorType` et qui désactive la protection CSRF ainsi
que le prefix.

> Vous pouvez vous inspirer du formulare [`App\Form\API\ApiSearchUserType`](../src/Form/API/ApiSearchUserType.php)

## Création d'un auteur

Dans le controller `App\Controller\AuthorController`, ajouter une méthode
`create` avec la route : `#[Route('', name: '....', methods: ['POST'])`.

Faire en sorte de pouvoir créer un nouvel auteur.

Vous pouvez tester avec le fichier [`request.http`](../request.http).

> Vous pouvez vous aider du controller [`App\Controller\API\UserController`](../src/Controller/API/UserController.php)

## Lister et filtrer les auteurs

Dans le controller `App\Controller\AuthorController`, ajouter une méthode
`list` avec la route : `#[Route('', name: '....', methods: ['GET'])`.

Faire en sorte de pouvoir lister et filtrer en utilisant un formulaire de rechercher.

Vous pouvez tester avec le fichier [`request.http`](../request.http).

> Vous pouvez vous aider du controller [`App\Controller\API\UserController`](../src/Controller/API/UserController.php)

## Afficher un auteur

Dans le controller `App\Controller\AuthorController`, ajouter une méthode
`show` avec la route : `#[Route('/{id}', name: '....', methods: ['GET'])`.

Faire en sorte d'afficher en json l'auteur avec l'id.

Vous pouvez tester avec le fichier [`request.http`](../request.http).

> Vous pouvez vous aider du controller [`App\Controller\API\UserController`](../src/Controller/API/UserController.php)

## Modifier un auteur

Dans le controller `App\Controller\AuthorController`, ajouter une méthode
`update` avec la route : `#[Route('/{id}', name: '....', methods: ['PATCH'])`.

Faire en sorte de récupérer et modifier l'auteur en utilisant le `ApiAuthorType`.

Vous pouvez tester avec le fichier [`request.http`](../request.http).

> Vous pouvez vous aider du controller [`App\Controller\API\UserController`](../src/Controller/API/UserController.php)

## Supprimer un auteur

Dans le controller `App\Controller\AuthorController`, ajouter une méthode
`remove` avec la route : `#[Route('/{id}', name: '....', methods: ['DELETE'])`.

Faire en sorte de supprimer l'auteur et retourner l'auteur supprimé en json.

Vous pouvez tester avec le fichier [`request.http`](../request.http).

> Vous pouvez vous aider du controller [`App\Controller\API\UserController`](../src/Controller/API/UserController.php)
