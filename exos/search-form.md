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

## Formulaire de recherche pour les catégories

Créer un formulaire de recherche (et son DTO) pour les catégories. Ce formulaire doit contenir
les champs suivants :

| nom       | type                   | Valeur par défaut |
| --------- | ---------------------- | ----------------- |
| limit     | NumberType             | 10                |
| page      | NumberType             | 1                 |
| trier par | ChoiceType (id, name)  | id                |
| direction | ChoiceType (ASC, DESC) | ASC               |
| name      | TextType               | null              |

Dans le controller `AdminCategoryController` et dans la méthode `retrieve`, afficher
et utiliser le formulaire pour rechercher des catégories (graçe au CategoryRepository).

## Formulaire de recherche pour les auteurs

Créer un formulaire de recherche (et son DTO) pour les auteurs. Ce formulaire doit contenir
les champs suivants :

| nom       | type                   | Valeur par défaut |
| --------- | ---------------------- | ----------------- |
| limit     | NumberType             | 10                |
| page      | NumberType             | 1                 |
| trier par | ChoiceType (id, name)  | id                |
| direction | ChoiceType (ASC, DESC) | ASC               |
| name      | TextType               | null              |

Dans le controller `AuthorAdminController` et dans la méthode `retrieve`, afficher
et utiliser le formulaire pour rechercher des auteurs (graçe au AuthorRepository).

## Formulaire de recherche pour les livres dans l'administration

Créer un formulaire de recherche (et son DTO) pour les livres dans l'administration. Ce formulaire doit contenir
les champs suivants :

| nom        | type                   | Valeur par défaut |
| ---------- | ---------------------- | ----------------- |
| limit      | NumberType             | 10                |
| page       | NumberType             | 1                 |
| trier par  | ChoiceType (id, name)  | id                |
| direction  | ChoiceType (ASC, DESC) | ASC               |
| title      | TextType               | null              |
| authorName | TextType               | null              |
| prixMin    | NumberType             | null              |
| prixMax    | NumberType             | null              |

Dans le controller `BookAdminController` et dans la méthode `retrieve`, afficher
et utiliser le formulaire pour rechercher des livres (graçe au BookRepository).
