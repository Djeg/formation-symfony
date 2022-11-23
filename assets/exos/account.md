# Créer un système d'authentification par compte (Account)

En utilisant le support sur la sécurité, réaliser un système complet d'authentification.

## 1. Créer l'Account

Nous allons créer une entité « Account » en utilisant la commande `make:user` et personnaliser cette entité avec la commande `make:entity` avec les champs suivant :

| nom       | type     |
| --------- | -------- |
| id        | int      |
| email     | string   |
| password  | string   |
| roles     | array    |
| createdAt | datetime |
| updatedAt | datetime |

## 2. Modifier et attacher des utilisateurs

1. Supprimer le champs `password` de l'entitté utilisateur
2. Mettre en place une relation OneToMany entre « Account » et « User »

## 3. Les fixtures

Créer autant de fixtures « Account » qu'il y d'utilisateur. Attention les mots de passe doivent crypter, chaque utilisateur doit être relié à un Account.

## 4. Le Formulaire d'inscription

Créer un formulaire « registration » lié à un account avec les champs suivant :

| nom      | type         |
| -------- | ------------ |
| email    | EmailType    |
| password | RepeatedType |

## 5. Le Controller

Générer un controller « AccountController » avec une route d'inscription :

Ce controller doit utiliser le formulaire précédent afin d'enregistrer dans la base de données un nouveau compte.

> **ATTENTION** : Les mots de passe doivent être crypté !

## 6. La Vue

Afficher le formulaire d'inscription et faire en sorte de pouvoir l'envoyer :)

## 7. Générer le login

En utilisant la commande `make:auth`, généré votre formulaire de login et le personnaliser.
