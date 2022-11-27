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

## Les propositions

1. Je veux récupérer les 25 livres les plus chères
2. Je veux récupérer mes données personnel
3. Je veux créer un nouveau livre
4. Je veux modifier le livre n°3 de l'auteur n° 10
5. Je veux supprimer mon panier
6. Je veux récupérer l'auteur du livre avec l'id 5
7. Je veux modifier l'email de l'utilisateur 14
8. Je veux récupérer les 25 derniers commentaires du livre n°9
9. Je veux créer un nouveau commentaire sur le livre 12
10. Je veux « liker » le comtout les commentaires mentaire n° 23 sur le livre n°9

## Les solutions

1. Je veux récupérer les 25 livres les plus chères

| action | uri (endpoint)                               | type       | valide |
| ------ | -------------------------------------------- | ---------- | ------ |
| GET    | /books?limit=25&orderBy=price&direction=desc | Collection | OUI    |
| GET    | /books?limit=25&orderBy=-price               | Collection | OUI    |

2. Je veux récupérer mes données personnel

| action | uri (endpoint)    | type     | valide |
| ------ | ----------------- | -------- | ------ |
| GET    | /users/me         | Resource | Oui    |
| GET    | /me               | Resource | Oui    |
| GET    | /user/getAccount  | Resource | Non    |
| GET    | /users/mon-compte | Resource | Oui    |
| GET    | /user/id          | Resource | Non    |

3. Je veux créer un nouveau livre

| action | uri (endpoint)        | type                  | valide |
| ------ | --------------------- | --------------------- | ------ |
| POST   | /admin/livres/nouveau | Collection / Resource | Non    |
| POST   | /admin/livres         | Collection / Resource | Non    |
| POST   | /books/new            | Collection / Resource | Non    |
| POST   | /books/create         | Collection / Resource | Non    |
| POST   | /book/nouveau         | Collection / Resource | Non    |
| POST   | /book                 | Collection / Resource | Noui   |
| POST   | /books                | Resource              | Oui    |
| POST   | /books/1651651        | Resource              | Oui    |
| PATCH  | /books                | Collection / Resource | Oui    |

4. Je veux modifier le livre n°3 de l'auteur n° 10

| action      | uri (endpoint)           | type       | valide |
| ----------- | ------------------------ | ---------- | ------ |
| PATCH / PUT | /books?author=10/3/      | Resource   | Non    |
| PATCH / PUT | /livres/{3}/author id=10 | Resource   | Non    |
| PATCH / PUT | /books ?id3 author10     | Resource   | Non    |
| PATCH / PUT | /books?id=3&author=10    | Resource   | Non    |
| PATCH / PUT | /books/3                 | Resource   | Oui    |
| PATCH / PUT | /books                   | Collection | Oui    |
| PATCH / PUT | /authors/10/books/3      | Resource   | Oui    |

5. Je veux supprimer mon panier

| action | uri (endpoint)           | type     | valide |
| ------ | ------------------------ | -------- | ------ |
| DELETE | /carts/me                | Resource | Ouon   |
| DELETE | /me/cart                 | Resource | Oui    |
| DELETE | /mon-panier/harry-potter | Resource | Non    |
| DELETE | /user/id/cart            | Resource | Non    |
| DELETE | /mon-panier              | Resource | Oui    |
| DELETE | /cart                    | Resource | Oui    |
