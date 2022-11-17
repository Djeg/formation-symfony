# Faire un CRUD pour les utilisateurs

## 1. Créer l'entité et le repository ! (Créer le model)

Grâce aux commandes, créer une entité : « User » avec les champs suivants :

| nom            | type     | taille | null |
| -------------- | -------- | ------ | ---- |
| email          | string   | 255    | no   |
| password       | string   | 255    | no   |
| firstname      | string   | 255    | no   |
| lastname       | string   | 255    | no   |
| profilePicture | text     | -      | yes  |
| createdAt      | datetime | -      | no   |
| updatedAt      | datetime | -      | no   |

> **INDICE**
> Il y a 2 commandes, une pour générer l'entitél'autre pour mettre à jour la base de données ...

## 2. Créer le « UserType »

Grâce aux commandes, générer un formulaire pour les utilisateur : « UserType ».
Ce formulaire, doit contenir tout les champs (et leurs types) sauf les champs
de date !

## 2. Créer le « AdminUserController » !

Grâce aux commandes, générer un controller nommé : « AdminUserController »

## 3. Créer la méthode « create » qui permet de créer un utilisateur

Ajouter une méthode `create` à ce controller, avec la route suivante :

| uri                          | name                              | methods   |
| ---------------------------- | --------------------------------- | --------- |
| /admin/utilisateurs/creation | app_nomDuController_nomDeLaMethod | GET, POST |

Créer le formulaire des utilisateurs, le remplir, le valider, enregistré l'utilsateur en base de données et rediriger sur la liste.

Si le formulaire n'est pas valide, alors afficher le formulaire dans un template twig !

## 4. Créer la méthode « list »

Dans le même controller, ajouter un méthode `list` avec la route suivante :

| uri                 | name                              | methods |
| ------------------- | --------------------------------- | ------- |
| /admin/utilisateurs | app_nomDuController_nomDeLaMethod | GET     |

Ce controller doit récupérer tout les utilisateurs et afficher un template twig
qui liste ces derniers.

## 4. Créer la méthode « update »

Dans le même controller, ajouter un méthode `update` avec la route suivante :

| uri                      | name                              | methods  |
| ------------------------ | --------------------------------- | -------- |
| /admin/utilisateurs/{id} | app_nomDuController_nomDeLaMethod | GET,POST |

Créer le formulaire des utilisateurs, le remplir, le valider, enregistré l'utilsateur en base de données et rediriger sur la liste.

Si le formulaire n'est pas valide, alors afficher le formulaire dans un template twig !

## 5. Créer la méthode « remove »

Toujours dans le même controller, ajouter une méthode `remove` avec la route suivante :

| uri                                | name                              | methods |
| ---------------------------------- | --------------------------------- | ------- |
| /admin/utilisateurs/{id}/supprimer | app_nomDuController_nomDeLaMethod | GET     |

Dans ce controller, récupérer l'utilisateur avec l'identifiant passé en paramètre de route, puis en utilisant le repository, supprimer l'utilisateur.

Un fois terminé, rediriger vers la route de la liste !
