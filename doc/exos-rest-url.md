# Exercice de formation de requête RESTFull

Exemple : J'aimerais récupérer tout les plats

- **Requete**:

```
GET http://locahost:4444/dishes
```

- **Resource**: Collection

## 1. J'aimerais récupérer tout les ingrédients

- **Requete**:

```
GET http://localhost:4444/ingredients
```

- **Resource**: Collection

## 2. J'aimerais récupérer l'utilisateur avec l'id 4

- **Requete**:

```
GET http://localhost:4444/users/4 (OK, DOCUMENT)
GET http://localhost:4444/users?id=4 (OK, COLLECTION)
```

- **Resource**: Document

## 3. J'aimerais supprimer le plat avec l'id 2

- **Requete**:

```
DELETE http://localhost:4444/dishes/2 (OK, DOCUMENT)

GET http://localhost:4444/dishes (OK, COLLECTION)
GET http://localhost:4444/dishes?orderBy=price (OK, COLLECTION)
GET http://localhost:4444/dishes?id=4 (OK, COLLECTION)
DELETE http://localhost:4444/dishes?id=4 (OK, COLLECTION)
```

- **Resource**:
  Rien (OK)
  Document (OK)
  Collection (PAS OK)

## 4. J'aimerais créer un nouveau plat

- **Requete**:

```
POST http://localhost:4444/dishes (OK) (1 ou plusieurs plats à la fois (BATCH) => COLLECTION)
                                       (1 seul plat => PAS COLLECTION, DOCUMENT !)
```

- **Resource**:
- Document (OK)
- Collection (PRESQUE OK, MAIS NON)
- Rien (OK, C'EST TRES RARE)

## 5. J'aimerais modifier l'ingredient avec l'id 8

- **Requete**:

```
PUT http://localhost:4444/ingredients/8 (OK) (DOCUMENT)
PATCH http://localhost:4444/ingredients/8 (OK) (DOCUMENT)

PUT http://localhost:4444/ingredients?id=8 (OK) (COLLECTION)
PATCH http://localhost:4444/ingredients?id=8 (OK) (COLLECTION)
```

## 6. J'aimerais récupérer les ingrédients du plat avec l'id 9

- **Requete**:

```
GET http://localhost:4444/dishes/9/ingredients (OK) (COLLECTION)

GET http://localhost:4444/dishes?id=9/ingredients (PAS OK)

GET http://localhost:4444/ingredients?dishes=[9] (OK) (COLLECTION)
```

## 7. J'aimerais récupérer tout les plats dont le nom contient "Pizza"

- **Requete**:

```
GET http://localhost:4444/dishes?name=%Pizza% (OK) (COLLECTION)
```

## 8. J'aimerais ajouter un ingrédient au plat avec l'id 2

- **Requete**:

```
PUT/PATCH http://localhost:4444/dishes/2/ingredients (OK) (COLLECTION)

PUT/PATCH http://localhost:4444/dishes/2 (OK) (DOCUMENT)

POST http://localhost:4444/dishes/2/ingredients (OK - Créer et ajouter un ingrédient) (DOCUMENT & COLLECTION)
```

## 9. J'aimerais récupérer tout les plats ordonées par prix croissant et limiter à 4 résultat

- **Requete**:

```
GET http://localhost:4444/dishes?orderBy=price&limit=4&direction=ASC (OK) (COLLECTION)

GET http://localhost:4444/dishes?sort=+price&limit=4 (OK) (COLLECTION)

GET http://localhost:4444/dishes?orderBy=price-asc&limit=4 (OK) (COLLECTION)
```
