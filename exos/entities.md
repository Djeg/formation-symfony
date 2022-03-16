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

## Lister tout les livres

Dans le controller `BookController`, ajouter une méthode `list` avec la route suivante : `/livres`.

Récupérer tout les livres graçe à lé méthode `findAll` du `BookRepository`.

Ensuite, retourner une réponse avec une balise `p` pour chaque titre
de livre. Exemple:

```html
<p>Titre du premier livre</p>
<p>Titre du dexième livre</p>
<p>Titre du troisième livre</p>
```

## Récupérer un seul livre

Dans le controller `BookController`, ajouter une methode `one` avec la route suivante :
`/livres/{id}`.

Grace au repository `BookRepository` et à la méthode `find`, Récupéré le livre
avec l'identifiant passer dans le paramètre de la route.

Si il n'y pas ed livre, alors retourner une réponse avec le code HTTP 404,
Sinon retourner une réponse avec le titre du livre.

## Supprimer un livre

Dans le controller `BookController`, ajouter une methode `remove` avec la route suivante :
`/livres/{id}/supprimer`.

Grace au repository `BookRepository` et à la méthode `find`, Récupéré le livre
avec l'identifiant passer dans le paramètre de la route.

Supprimer le livre en utilisant le manager (`EntityManagerInterface` et la méthode `remove`).

Si le livre existe dans la base de données et qu'il a bien était supprimé
retourner une réponse avec le texte : `Le livre {id} à bien été supprimé`.

Si le livre n'éxiste pas dans la base de données retourner une réponse avec le code
http 404.
