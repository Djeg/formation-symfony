# Mettre en place la page de recherche

Créer une page `/rechercher` qui affiche les résultats d'une recherche
avec les filtres suivants :

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
