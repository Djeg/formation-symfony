# Formulaire de recherche des livres avancée !

## Modifier le DTO !

Dans la class `App\DTO\SearchBookCriteria` ajouter les propriétés public suivante
:

| nom              | type    | valeur par défaut |
| ---------------- | ------- | ----------------- |
| publishingHouses | ?array  | []                |
| orderBy          | ?string | 'title'           |
| direction        | ?string | 'ASC'             |
| limit            | ?int    | 25                |
| page             | ?int    | 1                 |

## Modifier le formulaire de recherche

Dans le formulaire `App\Form\SearchBookType` ajouter les champs suivant :

| nom              | type       | options                                                                                               |
| ---------------- | ---------- | ----------------------------------------------------------------------------------------------------- |
| publishingHouses | EntityType | required: false, multiple: true, expanded: true, entity: PublishingHouse::class, choice_label: 'name' |
| orderBy          | ChoiceType | required: true, choices: ['id', 'title', 'price']                                                     |
| direction        | ChoiceType | required: true, choices: ['ASC', 'DESC']                                                              |
| limit            | NumberType | required: true                                                                                        |
| page             | NumberType | required: true                                                                                        |

## Modifier le « finder »

Dans la class `App\Repository\BookRepository` modifier la méthode
`findByCriteria` afin de filtrer les livres avec les nouveaux
filtres spécifié plus haut :)
