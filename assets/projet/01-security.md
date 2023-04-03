# Partie 1 : La connexion et l'inscription

L'objectif de cette partie est de pouvoir inscrire et connécter des utilisateurs sur notre site de commerce LookBook !

## 1. User et inscription !

Avec les commande `symfony console make:entity` et `symfony console make:user`, générer les entités suivantes :

### Address

| champ      | type   | nullable |
| ---------- | ------ | -------- |
| city       | string | no       |
| postCode   | string | no       |
| address    | string | no       |
| complement | text   | yes      |

### User

| champ           | type     | nullable |
| --------------- | -------- | -------- |
| email           | string   | no       |
| password        | string   | no       |
| createdAt       | DateTime | no       |
| updatedAt       | DateTime | no       |
| firstname       | string   | no       |
| lastname        | string   | no       |
| profilePictire  | string   | yes      |
| deliveryAddress | relation | -        |
| billingAddress  | relation | -        |

> **ATTENTION** : Pensez à bien cryter le mot de passe

> **ATTENTION** : Trouver le bon type de relation pour les adresses !

### Les fixtures

À l'aide de fixtures, générez une 100aines d'adresse et au moins 50 utilisateur !

> Il vous faudra crypter un mot de passe à l'aide de la commande `symfony console secu:hash`

## L'inscription

1. Générer un controller, `UserController`
2. Ajouter une méthode `/inscription`
3. À l'aide d'un formulaire, ajouter la possibilité d'inscrire un utilisateur
4. Afficher et traiter l'inscription d'un utilisateur

> Essayer de faire le formulaire le plus simple possible !

## La connexion

À l'aide de la commande `symfony console make:auth`, générer le système de connexion !
