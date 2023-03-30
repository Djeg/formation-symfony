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

```
GET	/books?limit=25&orderBy=price&direction=DESC	Collection (Valide)
GET /books?limite=25&orderBy=price&direction=ASC
GET /books?limit=25&orderBy=price&direction=DSC Collection (Valide)
GET	/books?limit=25&orderBy=price&direction=DESC	Collection (Valide)


GET /books?limit=25&orderBy=-price

```

2. Je veux récupérer mes données personnel

```
GET /myData  Collection (Valide)
GET	/me Resource (VAlide)
GET  /users/124  Resource (Valide)

GET /profils/me Ressource (Valide)
```

3. Je veux créer un nouveau livre

```
POST	/books/toto	Collection (Invalide)

DELETE /books/create Ressource (Invalide)
POST /book/create Ressource (Invalide)
DELETE /books/new Collection (Invalide)

POST /book Ressource (Invalide)

POST /admin/books/create Resource (Invalide)


POST	/books/toto	Resource (Valide) (Dangereuse)
POST /books Collection (Resource) (Valide)
PATCH /books (Valide) (Dangereuse)
```

4. Je veux modifier le livre n°3 de l'auteur n° 10

```
PATCH	/authors/10/books/3	Ressource (Valide)

PUT /authors/10/books/3 (Valide)
PUT /authors/10/books/3 Ressource (Valide)

PATCH /author/10/book/3 -- Ressource (Invalide)

PUT /book/3?author_id=10 Ressource (Invalide)
PUT /books/3?author_id=10 Ressource (Valide)
PUT /books/3 Ressource (Valide)

```

5. Je veux supprimer mon panier

```
DELETE /mon-panier Ressource (Valide)
DELETE /mon-panier Collection/Ressource (Valide)
DELETE /cart/me (Invalide)
DELETE /users/me/cart (Valide)
DELETE /cart (Valide)
DELETE /myCart Ressource (Valide)
```

6. Je veux récupérer l'auteur du livre avec l'id 5

```
GET /author/books?id=5 Ressource (Invalide)
GET	/authors/5	Ressource (Invalide)
GET /authors?id=10/books?id=3 Collection (Invalide)
GET /author?book_id=5 Ressource (Invalide)

GET /books/5/author Resource (Valide)
GET /authors?book_id=5 Collection (Valide)
```

7. Je veux modifier l'email de l'utilisateur 14

```
PATCH /users/14 Ressource (Valide)

PATCH	/emails/users/14	Ressource (Invalide)
PATCH /emails?user=14 (Valide)

PATCH /admin/users/14 Ressource (Presque ...)
```

8. Je veux récupérer les 25 derniers commentaires du livre n°9

```
GET /books/9/comments?limit=25&orderBy=createdAt&direction=ASC Collection (Invalide)
GET /books/9/comments?limit=25&direction=DESC Collection (Valide)
GET /comments?limit=25&orderBy=DESC&book_id=9 Collection (Valide)
```

9. Je veux créer un nouveau commentaire sur le livre 12

```
POST /books/12/comment Ressource (Invalide)
POST /books/12/comments Ressource (Valide)
POST /books/12?comment=new (Invalide)
POST /comments?book_id=12 Ressource (Valide)
POST /comments Ressource (Valide)

POST /books/12/commentaires resource (Valide)
```

10. Je veux « liker » le commentaire n° 23 sur le livre n°9

```
POST /books/9?comments=23 (Valide)


PATCH /books/9/comments/23 (Valide)

PATCH /comments/23 (Valide)

# HTTP 2.1, c'est correct :
# LIKE /comments/23
```
