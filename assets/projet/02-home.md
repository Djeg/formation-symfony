# La page d'accueil

L'objectif de cet exercice est de générer une page d'accueil affichant les dernières annonces de vente de livre !

## L'annonce

Créer une entité `BookAd` avec les champs suivant :

| nom             | type     | nullable |
| --------------- | -------- | -------- |
| title           | string   | no       |
| description     | text     | yes      |
| imagesUrl       | array    | yes      |
| condition       | string   | no       |
| auteur          | string   | yes      |
| publishingHouse | string   | yes      |
| price           | float    | no       |
| createdAt       | datetime | no       |
| updatedAt       | datetime | no       |
| user            | relation | no       |

### Les fixtures

Généré environ 100 à 500 livres dans la base de données...

### Le `HomeController`

Générer un controlleur `HomeController`, ajouter une méthode `home` sur la route `/`.

Ce controlleur doit afficher une page avec les 25 derniers livres !

> N'hésitez pas à faire du design et une belle page d'accueil en vous inspirant de site déja existant. Pensez aussi à vos couleurs et vos polices.

## La recherche

### Le DTO

Créer un DTO qui contiendra les champs du formulaire de recherche des annonces :

| champ     | type    | default   |
| --------- | ------- | --------- |
| limit     | int     | 25        |
| page      | int     | 1         |
| orderBy   | string  | createdAt |
| direction | string  | DESC      |
| title     | ?string | null      |
| minPrice  | ?int    | null      |
| maxPrice  | ?int    | null      |
| users     | ?array  | null      |

### Le formulaire de recherche

Avec la commande `symfony console make:form`, genérer un formulaire `BookAdSearch` avec les champs du DTO !

> Pense à bien configurer vos champs, c'est un formulaire de recherche.

### La page de recherche

Dans le `HomeController` créer une page `search` qui éxécute et affiche le formulaire de recherche.

> **BONUS** : Dans un menu, ajouter une petit barre de recherche permettant de lancer une recherche depuis partout sur le site ...
