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

## Dévélopper une API REST avec symfony

Pour commencer à dévélopper une api avec symfony, il faut tout d'abord que Symfony puisse comprendre le `JSON` :

```
symfony composer require symfony-bundles/json-request-bundle
```

### Retourner du JSON, à la place de HTML ?

L'idée d'une api REST est de retourner soit des collections, soit des resources. En symfony, une resource correspond généralement à une entité et les collections se sont généralement des tableaux d'entités !

Pour retourner dans nos controller notre entité ou notre tableaux d'entité en json :

```php
public function test(BookRepository $repository): Response
{
  // Je récupére un tableaux contenant tout les livres
  $books = $repository->findAll();

  // Pour afficher du json :
  return $this->json($books);
}

public function test2(Book $book): Response
{
  return $this->json($book);
}
```

### Ignorer des champs dans votre JSON !

Dans certains cas, nous ne souhaitons pas afficher le champs dans notre objet JSON (information confidentiel etc ...). Il suffit de retoucher l'entité concerné et d'utiliser l'attribut `#[Ignore]` :

```php
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    //....

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Ignore]
    private ?string $password = null;

    // ...
}

```

## Tester des api REST

Pour tester des API Rest (qui utilise JSON et le protocole HTTP), nous avons différents choix.

1. Vous pouvez un client « rest » comme par exemple : [postman](https://www.postman.com/)
2. Une extension VSCode très pratique [REST Client](https://marketplace.visualstudio.com/items?itemName=humao.rest-client)

Pour utiliser VSCode et le REST Client, il faut ou d'abord créer un fichier à la racine du projet nommé `cequevousouhaitez.http` (`request.http`)

Dans ce fichier nous allons pouvoir écrire nos propres HTTP et consulter la vértiable réponse HTTP !

Exemple de fichier `request.http` :

```http
# Le diése permet d'écrire des commentaires
# Le principe est simple, écrire nos propres requêtes HTTP :
GET http://127.0.0.1:12000/api/users
Content-Type: application/json

# Le triple diése permet d'écrire une nouvelle requête
###

GET http://127.0.0.1:12000/api/books
Content-Type: application/json
```
