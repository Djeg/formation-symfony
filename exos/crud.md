# Exercice : Faire un CRUD

Un CRUD est la possibilité de créer, récupérer, mettre à jour et
supprimer une ou des données.

## CRUD de Livre

### 1. Lister

Dans le controller `BookController`. Ajouter une page
pour lister les livres (Vous pouvez réutiliser la méthode `list`). Les champs suivant doivent être
visible:

- id
- title
- price

### 2. Mettre à jour

Dans le controller `BookController`. Ajouter une méthode
update, qui prend la route suivante : `/livres/{id}/modifier`.

Cette route doit affiché un formulaire de modification d'un livre
et donner la possibilité d'envoyer le formulaire et de modifier
le live.

Ajouter un lien vers cette page dans la page de liste.

### 3. Supprimer

Dans le controller `BookController`. Modifier la méthode
`remove` pour rediriger vers la page de liste lorsqu'une
suppression c'est bien passé.

Ajouter un lien vers la suppression dans la page de liste.

## CRUD des auteurs

### 1. Générer l'entité

Générer une entité `Author` avec les champs suivant:

| nom         | type   | nullable |
| ----------- | ------ | -------- |
| name        | string | no       |
| description | text   | no       |
| image       | string | yes      |

### 2. Lister les auteurs

Dans un controller `AuthorController`, ajouter une méthode
`list` avec la route suivante : `/auteurs`.

Afficher dans une page tout les auteurs.

### 3. Créer un auteur

Dans un controller `AuthorController`, ajouter une méthode
`create` avec la route suivante : `/auteurs/nouveau`.

Afficher un formulaire pour créer un auteur et lors de l'envoie
du formulaire ajouter l'auteur dans la base de données.

Une fois l'auteur enregistré, rediriger ves la liste des auteurs

Ajouter un lien pour créer un auteur dans la page de liste.

### 4. Mettre à jour un auteur

Dans un controller `AuthorController`, ajouter une méthode
`update` avec la route suivante : `/auteurs/{id}/modifier`.

Afficher un formulaire pour modifier un auteur et lors de l'envoie
du formulaire modifier l'auteur dans la base de données.

Une fois l'auteur modifié, rediriger ves la liste des auteurs

Ajouter un lien pour modifier un auteur dans la page de liste.

### 5. Supprimer un auteur

Dans un controller `AuthorController`, ajouter une méthode
`remove` avec la route suivante : `/auteurs/{id}/supprimer`.

Une fois l'auteur suprrimer, rediriger ves la liste des auteurs.

Ajouter un lien pour supprimer un auteur dans la page de liste.

## CRUD des catgégories

### 1. Générer l'entité

Générer une entité `Category` avec les champs suivant:

| nom  | type   | nullable |
| ---- | ------ | -------- |
| name | string | no       |

### 2. Lister les catégories

Dans un controller `CategoryController`, ajouter une méthode
`list` avec la route suivante : `/categories`.

Afficher dans une page toutes les catégories.

### 3. Créer une catégorie

Dans un controller `CategoryController`, ajouter une méthode
`create` avec la route suivante : `/categories/nouvelle`.

Afficher un formulaire pour créer une catégories et lors de l'envoie
du formulaire ajouter la catégorie dans la base de données.

Une fois la catégorie enregistré, rediriger ves la liste des catégories

Ajouter un lien pour créer une catégorie dans la page de liste.

### 4. Mettre à jour une catégorie

Dans un controller `CategoryController`, ajouter une méthode
`update` avec la route suivante : `/categories/{id}/modifier`.

Afficher un formulaire pour modifier une catégorie et lors de l'envoie
du formulaire modifier la catégorie dans la base de données.

Une fois la catégrorie modifié, rediriger ves la liste des catégories

Ajouter un lien pour modifier une catégorie dans la page de liste.

### 5. Supprimer une catégorie

Dans un controller `CategoryController`, ajouter une méthode
`remove` avec la route suivante : `/categories/{id}/supprimer`.

Une fois la catégorie suprrimer, rediriger ves la liste des catégories.

Ajouter un lien pour supprimer une catégorie dans la page de liste.

## Menu de navigation

Que l'on soit sur n'importe quelle page de CRUD pour les livres,
auteurs ou catégorie. Ajouter la possibilité de naviguer sur les
différentes liste en utilisant un menu.

Vous pouvez rajouter votre propre style css !
