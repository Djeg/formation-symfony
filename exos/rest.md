# Création d'url pour une api web RESTFULl

Dans ces exercices, nous immaginons créé une api pour un site
de vente de vêtements : `https://monapi.com`

Pour chaque exercice il est demandé de spécifier l'action (
la méthode HTTP) ainsi que l'url correspondant à la question.

Vous pouvez avoir plusieurs solutions.

Spécifier aussi si la resource est un **document** ou une
**collection**

Retenez que les formation d'url sont libre, les collections
sont généralement au pluriel, les filtres se situe toujours
à la fin de la resource, les resource sont IMMUABLE.

## Rappel des action :

-   `GET` : Obtenir / Récupérer
-   `POST` : Créer / Ajouter
-   `PUT/PATCH` : Modifier
-   `DELETE` : Supprimer

## Exemple :

Je veux récupérer tout les utilisateurs :

```
GET https://monapi.com/users (COLLECTION)
```

## Les exos !

1. Je veux récupérer tout les vétements que je vend

2. Je veux récupérer les vétements de type "pantalon", trier par "prix" croissant

3. Je veux afficher le detail du pantalon avec l'id 4

4. Je veux créer un nouveau vétement

5. Je veux supprimer le vêtement avec l'id 4

6. Je veux modifier le vétement avec l'id 2

7. Je veux récupérer tout les vétements de la catégorie "êté" trié par prix croissant

8. Je veux récupérer tout les vêtement qu'a commandé l'utilisateur avec l'id 3

9. Je veux modifier mes informations personnel

10. Je supprimer tout les vétements qu'a acheté l'utilisateur avec l'id 2
