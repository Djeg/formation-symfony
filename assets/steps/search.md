# Mettre en place la page de recherche

L'objéctif de cette exercice est de créer une page `/rechercher` qui affiche les résultats d'une recherche avec les filtres suivants :

| Nom du filtre    | type    | défaut    |
| ---------------- | ------- | --------- |
| page             | int     | 1         |
| limit            | int     | 10        |
| orderBy          | string  | createdAt |
| direction        | string  | DESC      |
| type             | ?string | null      |
| minTotalAre      | ?int    | null      |
| maxTotalArea     | ?int    | null      |
| minPrice         | ?int    | null      |
| maxPrice         | ?int    | null      |
| minNumberOfRooms | ?int    | null      |
| maxNumberOfRooms | ?int    | null      |
| address          | ?string | null      |

## Etape 1 - Le DTO

La première étape est de créer un DTO (un objet contenant tout les filtres de recherche). Pour cela créé une classe PHP dans `src/DTO/RealPropertySearchCriteria` et ajouter tout les critères de recherches (page, limite, orderBy etc ...).

## Etape 2 - Le Repository et le QueryBuilder

L'étape suivante c'est la création d'un « finder » dans le repository. Pour cela créé une méthode `findAllBySearchCriteria` dans le repository `RealRepository`. Cette méthode reçoit le DTO `RealPropertySearchCriteria` et, avec l'aide du query builder, construit la requête récupérant les bon biens immobilier.

## Etape 3 - Le formulaire

Vous pouvez ensuite générer et adapter un formulaire pour le DTO `RealPropertySearchCriteria`. Vous êtes libre pour le nommage et l'emplacement de ce formulaire.

> Attention : Ce formulaire est un formulaire de recherche, il y auras de options à rajouter !

## Etape 4 - Le Controller

Maintenant que nous avons mis en place tout le code nescessaire au bon fonctionnement de la page, dans le controller `HomeController` créé lors de l'exercice suivant, créé une page "rechercher" qui utilise la formulaire et le repository et finalement affiche la page de recherche :)
