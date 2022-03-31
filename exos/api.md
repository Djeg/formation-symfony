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
