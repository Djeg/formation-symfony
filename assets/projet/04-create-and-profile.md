# Déposer une annonce & Mon Profil

L'objectif de cet exercice est de pouvoir déposer une annonce, consulter et modifier les informations de notre profil ainsi que de supprimer certaines de nos annonces.

## Déposer une annonce

Créer un `BookAdController` et ajouter une méthode `new` (`/vendre-livre`). Ce controlleur doit afficher un formulaire avec les champs suivant :

| champ           | type         | requis |
| --------------- | ------------ | ------ |
| title           | TextType     | yes    |
| price           | MoneyType    | yes    |
| description     | TextareaType | no     |
| author          | TextType     | no     |
| publishingHouse | TextType     | no     |

> **BONUS** : Ajouter la possiblité de spécifier une URL pour l'image du livre

Une fois le formulaire remplie, enregistré l'annonce dans la base de données attaché à l'utilisateur connécté.

> Ce controlleur n'est accessible qu'aux utilisateurs connécté

## Mon Profil

Créer un controller `ProfileController` et ajouter une méthode `/mon-profil`. Cette méthode doit afficher mes informations personnelles ainsi que les mes annonces de livres à vendre.

## Modifier une de mes annonces

Dans le `BookAdController` ajouter une méthode `/annonces/{id}/modifier` qui permet de modifier une annonce.

> Il faudra reprendre le formulaire de dépot d'annonce ..

> **IMPORTANT** : Je ne peux modifier que **mes annonces**, pas celle d'un autre utilisateur !

## Supprimer une annonce

Dans le `BookAdController` ajouter une méthode `/annonces/{id}/supprimer` qui suprime une de mes annonces.

> N'éhistez pas à ajouter des liens dans la page de mon profile
