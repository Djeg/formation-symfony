# Formation Symfony 6 - Intermédiaire

Dans cette formation vous approfondirez vos connaissances Symfony 6
avec les Formulaires et les relations doctrine :).

Au programme: Réaliser un formulaire de recherche complet et complexe !

## Installation

Pour installer ce projet chez vous suivez le guide :

1. [Télécharger](https://github.com/Djeg/formation-symfony/archive/refs/heads/session/28-03-22.01-04-22.zip) ou cloner ce repository sur votre machine
2. Ouvrez le projet dans VSCode
3. Configuré votre base de données dans le fichier `.env`
4. Intaller les dépendances avec la commande : `composer install`
5. Créez la base de données avec la commande : `symfony console doctrine:database:create`
6. Créez votre schèma avec la commande : `symfony console doctrine:schema:update --force`
7. Insérer les données dans la base avec la commande : `symfony console hautelook:fixtures:load`
8. Démarrez le serveur symfony avec la commande : `symfony server:start`

## Documentation

Vous retrouverez les slides de la formation [ici](https://slides.com/davidjegat-1/sf5-training-foundation/fullscreen).

Vous retrouverez aussi dans le répertoire [`doc`](./doc) toute la série de document
servant de support au cours :).

Vous avez aussi la possibilité d'utiliser [l'éditeur de code github](https://github1s.com/Djeg/formation-symfony/archive/refs/heads/session/28-03-22.01-04-22) afin
d'explorer le projet.

## Exercices

1. [La requête et la réponse](./exos/request-response.exos.md)
2. [Les entitès](./exos/entities.md)
3. [La vue (Twig)](./exos/twig.md)
4. [Faire un CRUD](./exos/crud.md)
5. [Les formulaires & Relations](./exos/form.md)
6. [Les Query Builder (les requêtes à la base de données)](./exos/query-builder.md)
7. [Les fixtures](./exos/fixtures.md)
8. [Le formulaire de recherche](./exos/search-form.md)
9. [Le Frontend](./exos/frontend.md)
10. [La sécurité](./exos/security.md)
