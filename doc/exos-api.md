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

## Api pour les auteurs

### 1. Lister tout les auteurs

Créez un controller `API\AuthorController`. Ajouter une
méthode "list" avec le route : `GET /api/authors`.

Retourner en json tout les auteurs

### 2. Créer un nouvel auteur

Créez un formulaire d'api `AuthorType`. Ajouter une
méthode "create" au controller `AuthorController` de l'api
avec la route : `POST /api/auteurs`

Valider le formulaire et retourner l'auteur créé en JSON

### 3. Afficher un auteur

Dans le controller `AuthorController`; ajouter une méthode
`get` avec la route suivante : `GET /api/authors/{id}`.

Retourner l'auteur en JSON

### 4. Modifier un auteur

Dans le controller `AuthorController`; ajouter une méthode
`update` avec la route suivante : `PATCH /api/authors/{id}`.

Mettre à jour et retourner l'auteur en JSON

### 5. Supprimer un auteur

Dans le controller `AuthorController`; ajouter une méthode
`delete` avec la route suivante : `DELETE /api/authors/{id}`.

Supprimer l'auteur et le retourner en JSON

## Api pour les livres

Répéter les mêmes opération que pour les auteurs

### 1. Lister tout les livres

### 2. Créer un nouvel livre

### 3. Afficher un livre

### 4. Modifier un livre

### 5. Supprimer un livre
