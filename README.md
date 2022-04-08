# PizzaShop

Pizza Shop est un site de vente en ligne de pizza. Afin
de réaliser une semaine de projet symfony complète :).

## Installation

1. [Télécharger](https://github.com/Djeg/formation-symfony/archive/refs/heads/session-projet/04-04-22.08-04-22.zip) ou cloner le projet
2. Ouvrez avec VSCODe
3. Éditez le paramètre `DATABASE_URL` dans le fichier `.env`
4. Installez les dépendances : `composer install`
5. Créez la base de données : `symfony console doctrine:database:create`
6. Créez le schèma de la base : `symfony console doctrine:schema:update --force`
7. Insérez les fixtures : `symfony console hautelook:fixtures:load`
8. Démarrez le serveur symfony : `symfony server:start`

## Cahier des charges

Cette application est une pizzeria contenant les fonctionallité suivant:

1. Un backend avec:

- Une gestion des utilisateurs et de leurs address (CRUD)
- Une gestion des pizzas (ajouter, éditer, supprimer et modifier)
- Une gestion des commandes (Voir les commandes en cours, consulter les
  commandes passé)

2. Un frontend avec:

- Une page d'accueil avec les pizzas
- Un panier
- Une connexion
- Une inscription
- La possibilité de passer une commande
- En bonus : Configurez et commandez une pizza personnalisé

## Organiser votre travail

En symfony, lorsque nous avons une nouvelle fonctionalité
il suffit de suivre ces étapes :

1. Le DTO ou Le/Les Entité(s)
2. Les Formulaires
3. Le Repository
4. Le Controller
5. Le HTML / CSS

## Suivez le guide

Afin de réaliser cette application, vous trouverez l"intégralité du design
juste [ici](https://www.figma.com/file/UTthEDYvWiqKHjANXyYK6O/PizzaShop?node-id=0%3A1).

Vous pouvez aussi vous aider des anciennes sessions Symfony :

- [Session 1](https://github.com/Djeg/formation-symfony/tree/session/14-03-22.18-03-22)
- [Session 2](https://github.com/Djeg/formation-symfony/tree/session/21-03-22.25-03-22)
- [Session 3](https://github.com/Djeg/formation-symfony/tree/session/28-03-22.01-04-22)

Vous avez aussi à disposition des slides juste [ici](https://slides.com/davidjegat-1/sf5-training-foundation/fullscreen)
