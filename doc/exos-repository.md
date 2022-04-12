# Exos repository

## Trier les livres par prix max et min

Dans le controller `BookController`, ajouter une méthode
`listByPrice` avec la route suivante : `/admin/livres/par-prix/{min}/{max}`.

Dans le BookRepository, créé une méthode `findByPriceBetween` avec 2 paramètre:
`float $min, float $max` et en utilisant le query builder filtré tout les livre
dont le prix est contenue entre le `$min` et le `$max`. Ordonné les résultats
par prix croissant.

Utilisez cette méthode dans le `BookController` et affichez les résultats
dans un template twig.

## Rechercher un auteur

Dans le controller `AuthorController`, ajouter une méthode
`listByName` avec la route suivante : `/admin/auteurs/par-nom/{name}`.

Dans le `AuthorRepository`, ajouter une méthode `findByName` qui
récupére tout les auteurs contenant la rechecher demandé dans leurs nom
(utilisez le LIKE). Ordonnée les résultat par `name` décroissant.

## Recherche de livre par auteur

Dans le controller `BookController`, ajouter une méthode
`listByAuthorName` avec la route suivante : `/admin/livres/par-auteur/{authorName}`.

Dans le BookRepository, créé une méthode `findByAuthorName` avec 1 paramètre:
`string $authorName` et en utilisant le query builder filtré tout les livre
dont le nom de l'auteur contient la string $authorName (utilisez LIKE ainsi que
le leftJoin...). Ordonné les résultats par prix croissant.

Utilisez cette méthode dans le `BookController` et affichez les résultats
dans un template twig.

## Mettre en place des catégories

Créez une entité `Category` avec les champs suivant :

`

- id
- title (string)
- createdAt (datetime)
- updatedAt (datetime)
  `

Créez des fixtures pour ces catégories (générez environ une centaine de catégories).

Attaché grace à une relation ManyToMany les catégories aux livres.

Toujours dans les fixtures, relier les livres à 2 catégories aléatoires

Faire une page de recherche par catégorie pour les livres avec la route
suivante : `/admin/livres/par-categorie/{nomCategory}`.
