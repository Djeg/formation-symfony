# Page de recherche de livres

## Création du DTO

Créer une class `App\DTO\SearchBookCriteria` avec les propriétés public
suivantes :

| nom        | type   | valeur par défaut |
| ---------- | ------ | ----------------- |
| title      | string | `''`              |
| authors    | array  | `[]`              |
| categories | array  | `[]`              |
| minPrice   | ?float | null              |
| maxPrice   | ?float | null              |

## Création du Formulaire de recherche

À l'aide de la commande `symfony console make:form SearchBook` créer un formulaire
`SearchBookType` qui doit remplir la class `\App\DTO\SearchBookCriteria`.

Ce formulaire doit utiliser la méthode `GET` et ne doit pas avoir de protection
csrf (`'method' => 'GET', 'csrf_protection' => false`) !

Il doit contenir les champs suivant :

| nom        | type       | requis |
| ---------- | ---------- | ------ |
| title      | TextType   | false  |
| authors    | EntityType | false  |
| categories | EntityType | false  |
| minPrice   | MoneyType  | false  |
| maxPrice   | MoneyType  | false  |

## Création du « finder » de recherche

Dans le repository `BookRepository`, ajouter un méthode `findByCriteria` qui
accépte un paramètre de type `\App\DTO\SearchBookCriteria` et qui retourne
tout les livres filtré par les critéres de recherche en utilisant
le query builder.

## Création de la page de recherche

Dans le controller `HomeController` ajouter une méthode `search` avec
la route `/search`. Afficher le formulaire le recherche ainsi que tout
les livres correspondant à la recherche.
