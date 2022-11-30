# Concevoir notre api pour « LookBook »

Le principe de l'api est de proposer des « endpoints » (URI) afin que notre application soit utilisable sur des téléphones :)

Le but de l'exercice est simple, des propositions vous seront faites et vous devrez données l'uri, l'action et le type :

exemple :

Poposition :

**Je veux récupérer les 10 derniers livre**

Solution :

| action | uri (endpoint)                                   | type       |
| ------ | ------------------------------------------------ | ---------- |
| GET    | /books?limit=10&orderBy=createdAt&direction=DESC | Collection |

> Attention : Il peut éxister énormement de solutions différentes. C'est à vous de trouver celle qui vous semble le plus logique.

Il vous faudra lancer la commande suivante permettant de crypter le JWT :

```bash
bin/sf console lexik:jwt:generate-key
```

## Les propositions

1. Je veux récupérer les 25 livres les plus chères
2. Je veux récupérer mes données personnel
3. Je veux créer un nouveau livre
4. Je veux modifier le livre avec l'id 3 de l'auteur avec l'id 10
5. Je veux supprimer mon panier
6. Je veux récupérer l'auteur du livre avec l'id 5
7. Je veux modifier l'email de l'utilisateur 14
8. Je veux récupérer les 25 derniers commentaires du livre avec l'id 9
9. Je veux créer un nouveau commentaire sur le livre 12
10. Je veux « liker » commentaire avec l'id 23 sur le livre avec l'id 9

## Les solutions

1. Je veux récupérer les 25 livres les plus chères

| action | uri (endpoint)                               | type       | Valide |
| ------ | -------------------------------------------- | ---------- | ------ |
| GET    | /books?limit=25&orderBy=price&direction=DESC | Collection | Oui    |
| GET    | /books?limit=25&orderBy=-price               | Collection | Oui    |

2. Je veux récupérer mes données personnel

| action | uri (endpoint) | type     | Valide |
| ------ | -------------- | -------- | ------ |
| GET    | /me            | Resource | Oui    |
| GET    | /profil/me     | Resource | Non    |
| GET    | /users/me      | Resource | Oui    |
| GET    | /users/account | Resource | Oui    |

3. Je veux créer un nouveau livre

| action | uri (endpoint) | type       | Valide |
| ------ | -------------- | ---------- | ------ |
| POST   | /books         | Resource   | Oui    |
| POST   | /livre/nouveau | Resource   | Non    |
| POST   | /books/create  | Collection | Non    |
| POST   | /livres        | Collection | Oui    |
| PATCH  | /books         | Collection | Oui    |

4. Je veux modifier le livre avec l'id 3 de l'auteur avec l'id 10

| action      | uri (endpoint)      | type       | Valide |
| ----------- | ------------------- | ---------- | ------ |
| PATCH / PUT | /livres/3           | Resource   | Oui    |
| PATCH / PUT | /books/3/authors/10 | Resource   | Non    |
| PATCH / PUT | /authors/10/books/3 | Resource   | Oui    |
| PATCH / PUT | /books              | Collection | Oui    |
| PATCH / PUT | /author/10          | Collection | Non    |

5. Je veux supprimer mon panier

| action | uri (endpoint)   | type       | Valide |
| ------ | ---------------- | ---------- | ------ |
| DELETE | /moi/mon-panier  | Resource   | Oui    |
| DELETE | /users/{id}/cart | Resource   | Oui    |
| DELETE | /cart            | Resource   | Oui    |
| DELETE | /panier/me       | Collection | Non    |
| DELETE | /me/cart         | Resource   | Oui    |

6. Je veux récupérer l'auteur du livre avec l'id 5

| action | uri (endpoint)                | type     | Valide |
| ------ | ----------------------------- | -------- | ------ |
| GET    | /books/5/author               | Resource | Oui    |
| GET    | /books/5                      | Resource | Oui    |
| GET    | /books/5?author               | Resource | Oui    |
| GET    | /books/5?fields=id,nom,author | Resource | Oui    |

7. Je veux modifier l'email de l'utilisateur avec l'id 14

| action | uri (endpoint)           | type     | Valide |
| ------ | ------------------------ | -------- | ------ |
| PATCH  | /users/14/email          | Resource | Non    |
| PUT    | /users/14/email          | Resource | Oui    |
| PATCH  | /users/14/modifier?email | Resource | Non    |
| PATCH  | /users/email=14          | Resource | Non    |

8. Je veux récupérer les 25 derniers commentaires du livre avec l'id 9

| action | uri (endpoint)                                               | type       | Valide |
| ------ | ------------------------------------------------------------ | ---------- | ------ |
| GET    | /books?id=9&commentLimit=25&orderBy=createdAt&direction=DESC | Collection | Non    |
| GET    | /books/9/comments?limit=25&orderBy=createdAt&direction=Desc  | Collection | Oui    |
| GET    | /comments?limit=25&orderBy=createdAt&direction=DESC&book=9   | Collection | Oui    |

9. Je veux créer un nouveau commentaire sur le livre 12

| action | uri (endpoint)     | type     | Valide |
| ------ | ------------------ | -------- | ------ |
| POST   | /books/12/comments | Resource | Oui    |
| POST   | /comments?book=9   | Resource | Oui    |

10. Je veux « liker » le commentaire avec l'id 23 sur le livre avec l'id 9

| action | uri (endpoint)             | type     | Valide |
| ------ | -------------------------- | -------- | ------ |
| POST   | /books/9/comments/23       | Resource | Non    |
| PATCH  | /books/9/comments/23       | Resource | Oui    |
| LIKE   | /books/9/comments/23       | Resource | Oui    |
| POST   | /books/9/comments/23/likes | Resource | Oui    |
| PUT    | /books/9/comment=23        | Resource | Non    |
| POST   | /like?book=9               | Resource | Non    |
| POST   | /likes?book=9              | Resource | Oui    |
| POST   | /likes                     | Resource | Oui    |
| POST   | /commentaires/23           | Resource | Non    |
| POST   | /commentaires/23/likes     | Resource | Oui    |
| PATCH  | /commentaires/23           | Resource | Oui    |
