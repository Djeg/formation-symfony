# Mettre en place la sécurité

Dans cette étape nous allons mettre en place la sécurité :

- L'inscription des clients
- La connexion
- La deconnexion

## Étape 1 - L'entité

Créé l'entité « Client » avec les champs spécifié dans le schèma de la base de données. Pas besoin de mettre en place les relations. Attention, cette entité doit être **connécté au système de sécurité de symfony**.

> Il vous faudra utiliser le `make:user`.

> Pour ajouter des champs la commande `make:entity` peut vous être utile

## Étape 2 - Les fixtures

Dans le fichier `fixtures/data.yml`, créé une 30 aines de clients.

> Vous pouvez crypter un mot de passe en utilisant la commande : `secu:hash`

## Étape 3 - L'inscription

Créer un formulaire afin d'inscrire un client sur le site internet.

Créer un controller, dans un dossier `Front` nommé `ClientController`.

> Pour générer un controller dans un dossier utiliser la commande : `make:controller Front\\ClientFrontController`

Dans ce controller, ajouter une méthode « inscription » (traduite en anglais) qui utilise le formulaire, affiche un template twig, traite le formulaire, crypte le mot de passe de l'utilisateur et l'enregistre en base de données.

> Pour l'instant ne faite pas de design

## Étape 4 - L'authentification

En utilisant la commande `make:auth`, mettre en place la connexion et la deconnexion d'un client :).

> vous pouvez personnaliser le nom des routes dans la configuration symfony ;)
