# CRUD des maisons d'éditions et des auteurs

## 1. Générer les entitié

Avec la commande `symfony console make:entity`, générez les entités suivante :

### PublishingHouse

| champ       | type     | nullable |
| ----------- | -------- | -------- |
| title       | string   | no       |
| description | string   | yes      |
| createdAt   | datetime | no       |
| updatedAt   | datetime | no       |

### Author

| champ       | type     | nullable |
| ----------- | -------- | -------- |
| title       | string   | no       |
| description | string   | yes      |
| nationality | string   | yes      |
| createdAt   | datetime | no       |
| updatedAt   | datetime | no       |

## 2. La génération des formulaires

Avec la commande `symfony console make:form` créer les formulaires suivants :

### PublishingHouseType

| champ       | type         |
| ----------- | ------------ |
| title       | TextType     |
| description | TextareaType |
| submit      | SubmitType   |

### AuthorType

| champ       | type         |
| ----------- | ------------ |
| title       | TextType     |
| description | TextareaType |
| nationality | ChoiceType   |
| submit      | SubmitType   |

## 3. Les controllers !

En répétant le même principe que pour les livres, créer 2 controller (`AdminPublishingHouseController`, `AdminAuthorController`) avec chacun 4 routes :

- Une pour la création
- Une pour la liste
- Une pour la mise à jour
- Une pour la suppression :)
