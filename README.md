# Formation Symfony 6 - Les fondamentaux

Dans cette formation vous apprendrez les fondamentaux de symfony 6.
Faire un CRUD d'entité.

## Installation

Pour installer ce projet chez vous suivez le guide :

1. [Télécharger](https://github.com/Djeg/formation-symfony/archive/refs/heads/session/21-03-22.25-03-22.zip) ou cloner ce repository sur votre machine
2. Ouvrez le projet dans VSCode
3. Intaller les dépendances avec la commande : `composer install`
4. Configuré votre base de données dans le fichier `.env`
5. Créez la base de données avec la commande : `symfony console doctrine:database:create`
6. Créez votre schèma avec la commande : `symfony console doctrine:schema:update --force`
7. Démarrez le serveur symfony avec la commande : `symfony server:start`

## Documentation

Vous retrouverez les slides de la formation [ici](https://slides.com/davidjegat-1/sf5-training-foundation/fullscreen).

Vous retrouverez aussi dans le répertoire [`doc`](./doc) toute la série de document
servant de support au cours :).

Vous avez aussi la possibilité d'utiliser [l'éditeur de code github](https://github1s.com/Djeg/formation-symfony/tree/session/21-03-22.25-03-22) afin
d'explorer le projet.

## Exercices

1. [La requête et la réponse](./exos/request-response.exos.md)
2. [Les entitès](./exos/entities.md)
3. [La vue (Twig)](./exos/twig.md)
4. [Faire un CRUD](./exos/crud.md)
5. [Les formulaires & Relations](./exos/form.md)
