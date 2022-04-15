# Exos API

## Formuler des URL RESTFull

Pour chaque proposition immagine l'url (ex: `GET http://xxx.com/livres` etc ...)

1. Je veux récupérer tout les livres

```
GET http://xxx.com/livres (OK)
```

2. Je veux créer un nouveau livre

```
POST http://xxx.com/livre (PAS OK)

POST http://xxx.com/livres (OK)
```

3. Je veux modifier les livres avec l'id 32

```
PUT/PATCH http://xxx.com/livre/32 (PAS OK)

PUT/PATCH http://xxx.com/livres/32 (OK)

PATCH http://xxx.com/livres/32 (OK)

PUT/PATCH http://xxx.com/livres=32 (PAS OK)

PUT/PATCH http://xxx.com/livres?id=32 (PRESQUE OK)
```

4. Je veux supprimer le commentaire avec l'id 56 du livre avec l'id 12

```
DELETE http://xxx.com/livre/12/commentaire/56 (PAS OK)

DELETE http://xxx.com/commentaires/56 (OK)

DELETE http://xxx.com/livres/12/commentaires/56 (OK)
```

5. Je veux récupérer les auteurs du livre avec l'id 23

```
GET http://xxx.com/auteurs/livres?id=23 (PAS OK)

GET http://xxx.com/livres?auteurs/23 (PAS OK)

GET http://xxx.com/livres/23/auteurs (OK)

GET http://xxx.com/auteurs?livres/23 (PAS OK)

GET http://xxx.com/auteurs?livres=23 (OK)
```

6. Je veux mettre à jour l'auteur avec l'id 10 du livre avec l'id 53

```
PUT/PATCH http://xxx.com/livres/53/auteurs/10 (OK)

PUT/PATCH http://xxx.com/livres/53?auteurs=10 (PAS OK)

PUT/PATCH http://xxx.com/authors/10 (OK)
```

7. Je veux récupérer les catégories du livre avec l'id 3 trier par title décroissant

```
GET http://xxx.com/categories/livres/?id=3&orderBy=-title (PAS OK)

GET http://xxx.com/categories?livres=3&titles=-3 (PAS OK)

GET http://xxx.com/livres/3?categories?title=-3 (PAS OK)

GET http://xxx.com/categories/livres?id=3&orderBy=title&direction=DESC (PAS OK)

GET http://xxx.com/livres/3/categories?orderBy=-title (OK)

GET http://xxx.com/categories?orderBy=title&direction=DESC&bookId=3 (OK)
```

8. Je veux modifier la catégorie avec l'id 47 du livre avec l'id 2

```
PUT/PATCH http://xxx.com/livres/2/categories/47 (OK)

PUT/PATCH http://xxx.com/categories/47/livres/2 (PAS OK)

PUT/PATCH http://xxx.com/categories/47 (OK)
```

9. Je veux modifier mes informations personnelles

```
PUT/PATCH http://xxx.com/user (OK)

PUT/PATCH http://xxx.com/users (PAS OK)

PUT/PATCH http://xxx.com/me (OK)
```

10. Je veux tout les livres de l'auteur 54 trier par prix croissant

```
GET http://xxx.com/livres/auteurs/54?orderBy=+prix (PAS OK)

GET http://xxx.com/livres/auteurs/54?orderBy=price&direction=ASC (PAS OK)

GET http://xxx.com/auteurs/54/livres?orderBy=+prix (OK)

GET http://xxx.com/books?orderBy=+prix&authorId=54 (OK)
```

10. Je veux récupérer toutes les catégories :

```
GET http://xxx.com/api/categories
```

1. Récupérer toutes les catégories

GET http://xxx.com/api/categories

2. Créer une catégorie

POST http://xxx.com/api/categories

3. Récupérer une seule catégorie par son id

GET http://xxx.com/api/categories/2

4. Mettre à jour une catégorie

PUT/PATCH http://xxx.com/api/categories/2

5. Supprimer une catégorie

DELETE http://xxx.com/api/categories/2
