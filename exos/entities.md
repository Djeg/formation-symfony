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
