# Finir notre API

## Les prérequis

Il est conseillé de commencer à partir du repo github (pull ou alors de réinstaller/téléchager le projet). Le bonus, toutes le libraires (nelmioApiDoc, jwt etc ... sont préinstallé).

> N'hésitez pas à lancer `bin/stop` et `bin/start` si vous faite pull

Il vous faudra suivre l'ordre de développement pour chaque « endpoint » de l'api :

1. Model / DTO
2. Fixtures
3. QueryBuilder
4. Form
5. Controller
6. Api Documentation

## Faire l'api pour les livres

Le but de l'éxercice est de créer tout les endpoints pour gérer les livres :

1. `POST /api/books`: Créer un nouveau livre
2. `GET /api/books`: Récupére la liste des livres avec ses filtres :

| nom du filtre | type    | default     |
| ------------- | ------- | ----------- |
| limit         | int     | 21          |
| page          | int     | 1           |
| orderBy       | string  | 'createdAt' |
| direction     | string  | 'DESC'      |
| searchText    | ?string | null        |
| genre         | ?string | null        |

3. `PATCH /api/books/{id}`: Met à jour un livre
4. `GET /api/books/{id}`: Récupére un livre
5. `DELETE /api/books/{id}`: Supprime un livre

## Faire l'api pour les users

Le but de l'éxercice est de créer tout les endpoints pour gérer les users :

1. `POST /api/users`: Créer un nouveau user
2. `GET /api/users`: Récupére la liste des users avec ses filtres :

| nom du filtre | type    | default     |
| ------------- | ------- | ----------- |
| limit         | int     | 21          |
| page          | int     | 1           |
| orderBy       | string  | 'createdAt' |
| direction     | string  | 'DESC'      |
| email         | ?string | null        |

3. `PATCH /api/users/{id}`: Met à jour un user
4. `GET /api/users/{id}`: Récupére un user
5. `DELETE /api/users/{id}`: Supprime un user

## Faire l'api pour les account

Le but de l'éxercice est de créer tout les endpoints pour gérer les account :

1. `POST /api/accounts`: Créer un nouveau account
2. `GET /api/accounts`: Récupére la liste des accounts avec ses filtres :

| nom du filtre | type    | default     |
| ------------- | ------- | ----------- |
| limit         | int     | 21          |
| page          | int     | 1           |
| orderBy       | string  | 'createdAt' |
| direction     | string  | 'DESC'      |
| email         | ?string | null        |

3. `PATCH /api/accounts/{id}`: Met à jour un account
4. `GET /api/accounts/{id}`: Récupére un account
5. `DELETE /api/accounts/{id}`: Supprime un account

## Faire l'api pour les ad

Le but de l'éxercice est de créer tout les endpoints pour gérer les ads :

1. `POST /api/ads`: Créer un nouveau ad
2. `GET /api/ads`: Récupére la liste des ads avec ses filtres :

| nom du filtre | type    | default     |
| ------------- | ------- | ----------- |
| limit         | int     | 21          |
| page          | int     | 1           |
| orderBy       | string  | 'createdAt' |
| direction     | string  | 'DESC'      |
| genre         | ?string | null        |
| author        | ?User   | null        |
| minPrice      | ?float  | null        |
| maxPrice      | ?float  | null        |

3. `PATCH /api/ads/{id}`: Met à jour un ad
4. `GET /api/ads/{id}`: Récupére un ad
5. `DELETE /api/ads/{id}`: Supprime un ad
