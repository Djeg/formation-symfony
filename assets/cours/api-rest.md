# Les API Rest(full)

Afin de communiquer avec n'importe quelle application, un serveur se doit d'implémenter une API Web. Cette dernière ne propose aucune interface, ce n'est qu'un intermediaire entre la base de donées et le client.

## Les Resource et Collection

REST est basé sur un système d'url, ou chaque URI peut-être représenté sous forme de « Resource » ou de « Collection »

| URI      | type       | JSON | Base de données |
| -------- | ---------- | ---- | --------------- |
| /books   | Collection | `[]` | table           |
| /me      | Resource   | `{}` | entrée          |
| /books/3 | Resource   | `{}` | entrée          |

## Les actions

Il est possible d'utiliser les « Méthodes HTTP » afin de réaliser des actions sur nos Resources ou Collection :

| Method | Traduction                                                                       |
| ------ | -------------------------------------------------------------------------------- |
| GET    | Obtenir : Récupére des resources ou collection                                   |
| POST   | Créer : Créer une nouvelle Resource ou collection                                |
| PUT    | Modifie l'intégralité : Modifie l'intégralité de la Resource ou de la Collection |
| PATCH  | Modifie une partie : Modifie une parie de la Resource ou de la Collection        |
| DELETE | Supprimer : Supprime un Resource ou un Collection                                |

Par exemple :

| Action | URI      | Traduction                                            |
| ------ | -------- | ----------------------------------------------------- |
| GET    | /books   | Récupére la collection de « book »                    |
| POST   | /books   | Créer la collection (mais aussi la resource) « book » |
| DELETE | /books/3 | On supprime la Resource livre avec l'id 3             |
| PATCH  | /me      | Éditer une partie de mes informations personnel       |

## Les régles immuable !!

### Les resources et collection « s'imbrique »

Comme un jeux de légos, les resources et collections peuvent s'imbriquer :

| Action | URI                      | type       |
| ------ | ------------------------ | ---------- |
| GET    | /books                   | Collection |
| GET    | /books/3                 | Resource   |
| GET    | /books/3/author          | Resource   |
| GET    | /books/3/author/comments | Collection |

On peut rembombiner les resources / collections et toujours retomber sur nos pieds

| Action | URI      | type       | valide |
| ------ | -------- | ---------- | ------ |
| GET    | /books   | Collection | Oui    |
| GET    | /books/3 | Resource   | Oui    |
| GET    | /book    | -          | Non    |
| GET    | /book/3  | Resource   | Non    |

## Les resource et collection sont immuable (ou presque)

Si, pout tel action j'ai Resource alors quelle que soit l'action j'aurais toujours une Resource. Il en est de même pour les collections !

| Action      | URI    | type       |
| ----------- | ------ | ---------- |
| GET         | /books | Collection |
| POST        | /books | Collection |
| PUT / PATCH | /books | Collection |
| DELETE      | /books | Collection |

Un exemple un peu plus difficile

| Action | URI         | type       |
| ------ | ----------- | ---------- |
| GET    | /books?id=2 | Collection |

## Les resources et collection peuvent être filtré

Avec l'utilisation de QueryString, nous pouvons « filtrer » nos resources ou collection.

> ATTENTION : Quelle que soit le filtres, les URI reste IMMUABLE

| Action | URI                                                | type       | explications                                                                   |
| ------ | -------------------------------------------------- | ---------- | ------------------------------------------------------------------------------ |
| GET    | /books?limit=10&page=2&ordery=price&direction=DESC | Collection | Grâce aux query string, je peux séléctionner et filtrer ma collection de livre |
