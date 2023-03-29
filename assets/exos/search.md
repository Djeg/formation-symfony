# La recherche

## La recherche de maisons d'édition

L'objectif est de pouvoir rechercher des maisons d'édition dans l'administration.

### 1. Le DTO

Créer un objet (et le dossier) `App\DTO\PublishingHouseCriteria`. Dans cet objet placez-y les propriétés suivante :

| nom   | type    | valeur par défaut |
| ----- | ------- | ----------------- |
| title | ?string | null              |
| limit | int     | 25                |
| page  | int     | 1                 |

### 2. Générer le formulaire de recherche

Avec la commande `symfony console make:form`, généré et adapté le formulaire de recherche `PublishingHouseSearchType` en utilisant le DTO plus haut.

> Aidez-vous des supports présent [ici](../cours/search-form.md)

### 3. La recherche dans le repository

Dans le repository `PublishingHouseRepository`, réaliser une méthode `findAllByCriteria` qui accépte le DTO plus haut et réalise la recherche dans la base de données (en utilisant le query builder).

### 4. Le controller

Dans le controller `AdminPublishingHouseController`, dans la méthode de liste, utilisé et afficher le formulaire de recherche.

## La recherche des livres !

Créer une page (`/rechercher`) qui permet de rechercher des livres avec les filtres suivant :

| nom                 | valeur par défaut |
| ------------------- | ----------------- |
| title               | null              |
| author              | null              |
| publishingHouse     | null              |
| limit               | 25                |
| page                | 1                 |
| Créé à partir de :  | null              |
| Créé au plus tard : | null              |
