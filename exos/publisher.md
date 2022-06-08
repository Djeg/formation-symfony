# La maison d'édition

## Génération de l'entité

Grace à la commande `symfony console make:entity`, générer une entité `PublishingHouse`
avec les champs suivant :

| nom         | type   | nullable |
| ----------- | ------ | -------- |
| name        | string | no       |
| description | text   | no       |
| country     | string | yes      |

Mettre à jour la base de données avec la commande : `symfony console d:s:u --force`

## Génération du formulaire

Créer grace à la commande `symfony console make:form` le formulaire : `AdminPublishingHouseType`.
Ajouter les champs suivant :

| nom         | type         | options         |
| ----------- | ------------ | --------------- |
| name        | TextType     | required: true  |
| description | TextareaType | required: false |
| country     | CountryType  | required: false |

## CRUD des maisons d'éditions

Créer un controller `Admin/PublishingHouseController`, ajouter et implémenter
les méthode : `create`, `update`, `list` et `remove`.

> Inspirez vous des controller existants !!!!

## Attacher la maisons d'édition à un livre

Grace à la commande `symfony console make:entity`, faire un sorte qu'un livre
soit attaché à **1** maison d'édition et qu'une maison d'édtion soit attaché à
**plusieurs** livres !

Retoucher le formulaire `AdminBookType` pour pouvoir séléctionner une maison
d'édition (required: false).
