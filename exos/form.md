# Exercice Formulaire

## Petit Rappel

Pour générer un `FormType` utiliser la commande : `symfony console make:form nom`.
Un `FormType` ext **obligatoirement** attaché à une class (entitée) à remplir.

### Liens utiles

- [Schèma de fonctionnement des formulaires](https://github.com/Djeg/formation-symfony/blob/session/21-03-22.25-03-22/doc/Form.png)
- [La liste des tout les form type de symfony](https://symfony.com/doc/current/reference/forms/types.html)

## Le formulaire des auteurs

Créer un form type `AuthorType` qui contient tout les champs
d'un auteur, plus un bouton submit (pas besoin de mettre le champs
`pictures`).

Dans le controller `AuthorAdminController`, modifier les méthodes
`create` et `update` pour utiliser le formulaire.

## Le formulaire des catégories

Créer un form type `CategoryType` qui contient tout les champs
d'une catégorie, plus un bouton submit.

Dans le controller `CategoryAdminController`, modifier les méthodes
`create` et `update` pour utiliser le formulaire.
