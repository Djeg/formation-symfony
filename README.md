# PizzaShop

Pizza shop est un projet d'entrainement de création d'application
en utilisant Symfony 6.

## Les Maquettes

Vous retrouverez les maquettes de l'application juste
[ici](https://www.figma.com/file/UTthEDYvWiqKHjANXyYK6O/PizzaShop?node-id=0%3A1)

## Installation

1. Cloner ou [Télécharger](https://github.com/Djeg/formation-symfony/archive/refs/heads/session-projet/20.06.22-24.06.22.zip) le projet sur votre ordinateur
2. Extraire le projet et l'ouvrir avec VSCode
3. Dans un terminal installer les dépendance avec la commande `symfony composer install`
4. Configurer votre base de données dans le fichier `.env`
5. Créer la base de données avec la commande : `symfony console doctrine:database:create`
6. Créer le schèma de la base de données avec la commande : `symfony console doctrine:schema:update --force`
7. Charger les fixtures avec la commande : `symfony console hautelook:fixtures:load -n`
8. Demarrer le server symfony : `symfony server:start`
