# Inscription à l'application

L'objectif est de pouvoir inscrire des utilisateurs dans notre application.

## Génération de l'utilisateur

En utilisant la commande `symfony console make:user` (`bin/sf console make:user`) généré une entité `User`

## Générer le formulaire d'inscription

En utilisant la commande `symfony console make:form` (`bin/sf console make:form`) généré un formulaire nommé `SignUpType` contenant les champs suivant :

| nom      | type         |
| -------- | ------------ |
| email    | EmailType    |
| password | RepeatedType |
| submit   | SubmitType   |

## Le controller et la page d'inscription

En utilisant la commande `symfony console make:controller` (`bin/sf console make:controller`) générer un controller : `UserController`.

Ajouter dans ce controller, une route `inscription` et plaez-y le code nescessaire au bon fonctionnement de l'inscription.

> N'oublier pas la partie HTML / TWIG !

## Les fixtures

En éditant le fichier `fixtures/data.yml`, ajouter environ 200 utilisateurs !
