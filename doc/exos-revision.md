# Exercice Révision

## 1. Doctrine

Générer les entités suivantes :

```
Book:
	- title (string)
	- description (text)
	- createdAt (datetime)
	- updatedAt (datetime)
	- price (float)

Author:
	- name (string)
	- description (text)
	- createdAt (datetime)
	- updatedAt (datetime)
```

Graçe à la commande `symfony console make:entity Book`, relier
le `Book` à l'`Author` en utilisant une relation OneToMany (le livre
possède un auteur, et l'auteur posséde plusieurs livres).

## 2. Le CRUD

### La liste des auteurs

Dans un controller `AuthorController` (vous pouvez le ranger dans un répertoire `Admin` à l'intérieur
de `Controller`).

On lui ajoute une route `/admin/auteurs` qui liste la totalité des auteurs.

### La création d'un auteur

Dans le controller `AuthorController` ajouter une route `/admin/auteurs/nouveau` qui
affiche un formulaire de création d'un auteur.

Lors de la soumission du formulaire, l'auteur doit être enregistré en base de données.

### La modification d'un auteur

Dans le controller `AuthorController` ajouter une route `/admin/auteurs/{id}/modifier` qui
affiche le formulaire de modification d'un auteur.

### La suppression d'un auteur

Dans le controller `AuthorController` ajouter une route `/admin/auteurs/{id}/supprimer` qui
supprime un auteur et redirige vers la liste des auteurs.

### La liste des livre

Dans un controller `BookController` (vous pouvez le ranger dans un répertoire `Admin` à l'intérieur
de `Controller`).

On lui ajoute une route `/admin/livres` qui liste la totalité des livres.

### La création d'un livre

Dans le controller `BookController` ajouter une route `/admin/livres/nouveau` qui
affiche un formulaire de création d'un livre.

Lors de la soumission du formulaire, le livre doit être enregistré en base de données.

### La modification d'un livre

Dans le controller `BookController` ajouter une route `/admin/livres/{id}/modifier` qui
affiche le formulaire de modification d'un livre.

### La suppression d'un livre

Dans le controller `BookController` ajouter une route `/admin/livres/{id}/supprimer` qui
supprime un livre et redirige vers la liste des livres.
