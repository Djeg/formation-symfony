# Symfony Perféctionnement

Dans cette session vous apprendrez à manier les formulaires,
doctrine et le query builder ainsi que mettre en relation
des entitès :).

## Comment installer ce projet ?

Pour installer ce projet, rien de plus simple :

- [Télécharger](https://github.com/Djeg/formation-symfony/archive/refs/heads/session/11-04-22.15-04-22.zip) le projet
- Ouvrez le projet dans VSCode
- Éditez le fichier `.env` afin de spécifier l'url de connexion à votre base de données (`DATABASE_URL`).
- Lancer la commande : `composer install`
- Lancer la commande : `symfony console doctrine:database:create`
- Lancer la commande : `symfony console doctrine:schema:update --force`
- Lancer le serveur symfony : `symfony server:start`

## Les supports

Vous retrouverez les slides de la formation juste [ici](https://slides.com/davidjegat-1/sf5-training-foundation/fullscreen)

## Les exercices

- [exos de révision](./doc/exos-revision.md)

## L'ordre de dévelopement

Quand on as une fonctionalité à développer, il suffit de suivre un ordre
simple :

1. Le DTO / L'entité
2. Le repository (faire les requêtes à la base de données si il y a)
3. Le FormType
4. Le controller
5. La vue (twig)
