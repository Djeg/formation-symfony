# Formation Symfony 6

Voici la formation symfony 6. Vous retrouverez aussi les liens des slides de la formation
ici :

- [Les slides](https://slides.com/davidjegat-1/sf5-training-foundation/fullscreen)

## Installer le projet

1. [Télécharger](https://github.com/Djeg/formation-symfony/archive/refs/heads/session/20-03-23/24-03-23.zip) (et dézipper) ou cloner le projet
2. Ouvrez le dossier du projet avec VSCode
3. Dans un terminal à la racine du projet lancer la commande : `composer install` (si elle échoue, tanter : `composer install--ignore-platform-reqs`)
4. Éditer la fichier `.env` et placez-y la connection à votre base de données dans le `DATABASE_URL`
5. Dans un terminal lancer les commandes :

```bash
$ symfony console do:da:cr
$ symfony console do:sc:up --force
$ symfony console ha:fi:lo -q --purge-with-truncate
$ symfony server:start
```

## La culture générale !

En symfony, nous développons des applications « HTTP ». Il faut donc comprendre ce qu'est le « web »
avant de commencer le code :

1. [Découvrir le web](./assets/cours/web.md)

## Les chapitres

1. [Installation (sans docker)](./assets/cours/installation.md)
2. [Installation (avec docker)](./assets/cours/installation-docker.md)
3. [Les Controller & Les Routes](./assets/cours/controller-et-routes.md)
4. [Le Model (Doctrine)](./assets/cours/doctrine.md)
5. [La Vue (Twig)](./assets/cours/view.md)
6. [Le request & les formulaires](./assets/cours/request-form.md)
7. [Les formulaires](./assets/cours/form.md)
8. [Mettre en ligne son application avec Heroku](./assets/cours/online.md)
9. [Les relations avec Doctrine](./assets/cours/relations.md)
10. [Les fixtures avec Alice](./assets/cours/fixtures.md)
11. [Le QueryBuilder](./assets/cours/query-builder.md)
12. [Les formulaires de « recherche »](./assets/cours/search-form.md)
13. [La sécurité (authentification et autorisation)](./assets/cours/security.md)
14. [Les API Rest](./assets/cours/api-rest.md)

## Le projet :

LookBook est votre objectif de cette semaine ! Un site de vente de livres entre particulier :).

1. [La connexion et l'inscription](./assets/projet/01-security.md)
