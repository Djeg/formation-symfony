# Les relations entre les Livres et Auteur / Maison d'édition

L'objectif de cet exercice c'est de pouvoir relier des données de notre base de données. En symfony, on ne relie pas les tables ensemble mais on relie les entitès !

## Relier le livre à un auteur

En utilisant le commande `symfony console make:entity`, modifier soit l'entité `Book`, soit l'entité `Author` afin de réaliser une relation entre les deux.

> Il vous faudra deviner le `type` de relation

## Attacher un auteur lors de la création d'un livre

Dans le formulaire de création d'un livre (`BookType`), ajouter un champs permettant de séléctionner un auteur !

> N'hésitez pas à tester votre code le plus rapidement possible !

## Relier le livre à une maison d'édition

En utilisant le commande `symfony console make:entity`, modifier soit l'entité `Book`, soit l'entité `PublishingHouse` afin de réaliser une relation entre les deux.

> Il vous faudra deviner le `type` de relation

## Attacher une maison d'édition lors de la création d'un livre

Dans le formulaire de création d'un livre (`BookType`), ajouter un champs permettant de séléctionner une maison d'édition !

> N'hésitez pas à tester votre code le plus rapidement possible !

## Créer un controlleur pour les auteurs

En utilisant la commande `symfony console make:controller` réer un controller nommé `AuthorController`

## Créer la page listant les auteurs

Dans ce controller ajouter une page `/auteurs` listant tout les auteurs de notre base de données.

> N'hésitez pas à ajouter votre HTML et un peu de style

## Créer le page de consultation d'un auteur

Toujours dans le même controlleur ajouter une page `/auteurs/{id}` qui affiche le détail d'un auteur (son titre etc ...) ainsi que **TOUT SES LIVRES** !

> N'oublier pas de faire un lien entre les deux pages !

> N'hésitez pas à ajouter votre HTML et un peu de style !
