# Le CRUD des pizzas

Votre objectif : Créer, Supprimer, Ajouter et modifier une pizza !

## 1. La connection à la base de données

Dans le fichier [`.env`](../.env), éditer la valeur `DATABASE_URL`
avec vos informations de base de données.

> ATTENTION : Démarrez LAMP, XAMPP, MAMP pour demarrez votre base de données

## 2. Créer votre base de données

À l'aide de la commande `symfony console doctrine:database:create`, créez votre
base de données.

## 3. Créer l'entité Pizza

À l'aide de la commande `symfony console make:entity`, créée une entité
Pizza avec les champs suivant :

| nom du champ | type du champ | nullable |
| ------------ | ------------- | -------- |
| name         | string        | no       |
| price        | float         | no       |
| description  | text          | yes      |
| imageUrl     | string        | yes      |

> ATTENTION !!! Une fois l'entité créé, utiliser la commande `symfony console doctrine:schema:update --force` (vous
> pouvez aussi utilisez `symfony console d:s:u --force`).

## 4. Créer le controller des pizzas

À l'aide de la commande `symfony console make:controller` créé un controller `PizzaController`.

## 5. La page de création (PARTIE 1, L'affichage)

Créé dans le controller de pizza, une page `/pizza/nouvelle` qui affiche un formulaire
avec les champs suivant :

| nom du champ | input    |
| ------------ | -------- |
| nom          | text     |
| prix         | number   |
| description  | textarea |
| imageUrl     | url      |

## 6. La page de création (PARTIE 2, la soumission du formulaire)

Lorsque le formulaire est soumis (méthode `POST`) :

1. Récupérer les champs du formulaire
2. Créer une entité pizza et remplir l'entité avec les champs du formulaire
3. Utiliser le `PizzaRepository` afin d'enregistrer la pizza dans la base de données
4. Si tout c'est bien passé : Rediriger vers la page de la liste des pizzas

## 7. La liste des pizzas

Créé dans le controller de pizza, une page `/pizza/liste` qui affiche toutes
les pizzas de la base donnnées.

Pour cela, utilisez le PizzaRepository afin de récupérer toutes les pizzas
de la base de données.

> Il doit y avoir d'afficher le nom et le prix de la pizza !

## 8. Modifier une pizza (PARTIE 1)

Dans le PizzaController, ajouter une page qui correspond à la route `/pizza/{id}/modifier`
vous pouvez nommer cette méthode « update ».

Récupérer le paramètre de route `id` et utilisez le `PizzaRepository` pour récupérer
la pizza avec l'identifiant spécifié dans la Route.

Afficher un formulaire avec les champs suivant :

| nom du champ | input    |
| ------------ | -------- |
| nom          | text     |
| prix         | number   |
| description  | textarea |
| imageUrl     | url      |

**ATTENTION** : Les champs doivent être préremplie avec ce que contient la pizza !

> ASTUCE : Vous pouvez utiliser la méthode `$repository->find($id)` afin de récupérer une pizza

## 9. Modifier une pizza (PARTIE 2)

Dans le PizzaController et dans la méthode update créé juste au dessus :

1. Tester si le formulaire à été envoyé
2. Récupérer les données du formulaire
3. Modifier la pizza avec les données du formulaire
4. Utiliser le repository afin d'enregistrer la pizza en base de données
5. Si tout c'est bien passé, rediriger vers la liste des pizzas

> ASTUCE : Vous pouvez utiliser `$repository->add($pizza, true);` afin d'enregistrer
> la pizza en base de données
