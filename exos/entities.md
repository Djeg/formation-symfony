# Exercices Entitès

Rappel des commandes doctrine :

| commande                                         | description                                                                 |
| ------------------------------------------------ | --------------------------------------------------------------------------- |
| `symfony console doctrine:database:create`       | Création de la base de données                                              |
| `symfony console doctrine:database:drop --force` | Supprime la base de données                                                 |
| `symfony console make:entity NomDeEntite`        | Création d'une class d'entité (attention ! No modifie la base de données !) |
| `symfony console doctrine:schema:update --force` | Met à jour la base de données par rapport à nos entitès                     |

## Générer une entité livre

Généré une entité livre avec les champs suivant :

| nom         | type   | nullable |
| ----------- | ------ | -------- |
| title       | string | no       |
| description | text   | yes      |
| price       | float  | no       |

## Insérer un nouveau livre

Dans un controller `BookController` qui hérite de `AbstractController`. Ajouter une méthode `new` attaché la route
suivante : `/book/new`

Dans cet méthode créer un noueau livre avec un titre, une description et un prix de votre choix.

Enregistrer ce livre dans la base de données en utilisant `EntityManagerInterface`.

Retourner une réponse qui affiche : `Livre $id : $titre`.

Vous pouvez tester cette route avec le fichier `request.http`.
