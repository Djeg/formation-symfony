# Formulaire de recherche des auteurs

## Création du DTO

Créer un class php `App\DTO\SearchAuthorCriteria` avec les propriétés public
suivante :

| Nom       | type    | valeur par défaut |
| --------- | ------- | ----------------- |
| name      | ?string | null              |
| orderBy   | ?string | 'id'              |
| direction | ?string | 'DESC'            |
| limit     | ?int    | 25                |
| page      | ?int    | 1                 |

## Création du formulaire

Avec la commande `symfony console make:form`, créer un formulaire `SearchAuthorType`
attaché à la class `\App\DTO\SearchAuthorCriteria`
avec comme option :

| Nom             | Valeur |
| --------------- | ------ |
| method          | GET    |
| csrf_protection | false  |

Ce formulaire doit posséder les champs suivant :

| Nom       | Type       | Options                                  |
| --------- | ---------- | ---------------------------------------- |
| name      | TextType   | required: false                          |
| orderBy   | ChoiceType | required: true, choices: ['id', 'name']  |
| direction | ChoiceType | required: true, choices: ['DESC', 'ASC'] |
| limit     | NumberType | required: true                           |
| page      | NumberType | required: true                           |

> Pour le choice type la documentation est [ici !](https://symfony.com/doc/current/reference/forms/types/choice.html)

## Ajout du « finder »

Dans le `AuthorRepository`, ajouter une méthode `findByCriteria` qui accépte
un objet `SearchAuthorCriteria` et retourne les livres filtré.

> Vous pouvez vous aider du [`BookRepository#findByCriteria`](../src/Repository/BookRepository.php#L81),
> ainsi que de la méthode `$qb->setFirstResult(($page - 1) * $limit)` afin de réaliser une pagination

## Modifier le controller

Dans le controller `App\Controller\Admin\AuthorController` modifier
la méthode `list` pour utiliser le formulaire de recherche et afficher
le formulaire dans son template twig

> Vous pouvez vous aider du [`HomeController#search`](../src/Controller/Front/HomeController.php#L30)
