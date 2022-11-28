# Les API Rest(full)

Afin de communiquer avec n'importe quelle application, un serveur se doit d'implémenter une API Web. Cette dernière ne propose aucune interface, ce n'est qu'un intermediaire entre la base de donées et le client.

## Les Resource et Collection

REST est basé sur un système d'url, ou chaque URI peut-être représenté sous forme de « Resource » ou de « Collection ». On nomme les URI d'une API Rest un « endpoint » :

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

## Les Filtres

Afin de filtrer nos resources et surtout nos collections, il est possible de les filtrer en utilisant des query string :

| URI                   | type       | JSON |
| --------------------- | ---------- | ---- |
| /books?page=2&limit10 | Collection | `[]` |

Les query string c'est tout ce qui se trouve après le `?`. Elles sont écrite sous cette forme :

```
<nomDuFiltre1>=<valeur>&<nomDuFiltre2>=<valeur>
```

> **Important** : Attention, les query string sont obligatoirement placé à la fin de l'URI. On ne peut pas placer des query string au milieu d'un URI.

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

| Action      | URI    | type                  |
| ----------- | ------ | --------------------- |
| GET         | /books | Collection            |
| POST        | /books | Collection / Resource |
| PUT / PATCH | /books | Collection            |
| DELETE      | /books | Collection            |

Un exemple un peu plus difficile

| Action | URI         | type       |
| ------ | ----------- | ---------- |
| GET    | /books?id=2 | Collection |

Quelle que soit les filtres, cela ne change en rien la représentation. Une collection reste toujours un collection, et de même pour une resource !

> **Cas Parrticulier** : Il éxiste un cas non correct mais admis, c'est le cas d'un POST sur une collection. En effet, la plupart des API, pour des raisons concernant des générations d'id, lors d'un requête POST sur une collection, alors une resource est autorisé

## Les resources et collection peuvent être filtré

Avec l'utilisation de QueryString, nous pouvons « filtrer » nos resources ou collection.

> ATTENTION : Quelle que soit le filtres, les URI reste IMMUABLE

| Action | URI                                                | type       | explications                                                                   |
| ------ | -------------------------------------------------- | ---------- | ------------------------------------------------------------------------------ |
| GET    | /books?limit=10&page=2&ordery=price&direction=DESC | Collection | Grâce aux query string, je peux séléctionner et filtrer ma collection de livre |
