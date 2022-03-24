# Formulaire de recherche

L'objectif est de créer une page `/trouver-livres` dans le `BookController`.

Cette page doit proposer un formulaire de recherche avec les champs
suivant :

| nom             | type                         |
| --------------- | ---------------------------- |
| titre           | TextType                     |
| limit           | NumberType                   |
| page            | NumberType                   |
| trier par       | ChoiceType (id, titre, prix) |
| direction       | ChoiceType (ASC, DESC)       |
| nom de l'auteur | TextType                     |
| categories      | EntityType                   |

Lorsque l'utilisateur remplie se formulaire, une recherche doit s'éfféctuer
dans le `BookRepository` et retourner tout les livres correspondant à la recherche.

### Les étapes

1. Il faut créer la class qui vas contenir les données du formulaire (ex: [SearchBook](./../src/DTO/SearchBook.php))
2. Créer le formulaire de recherche (`symfony console make:form SearchBook`)
3. Afficher ce formulaire dans la page `/trouver-livre` du `BookController`
4. Traiter l'envoie du formulaire: Graçe à l'objet SearchBook et au `BookRepository`, éfféctuer une recherche
