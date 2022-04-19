# Symfony Formation : Projet

Voici une semaine de formation projet autour d'une application
de commerce simple : Une pizzeria.

Vous retrouverez l'intégralité du design de l'application [ici](https://www.figma.com/file/UTthEDYvWiqKHjANXyYK6O/PizzaShop?node-id=0%3A1).

## Intructions d'installation

1. [Télécharger](https://github.com/Djeg/formation-symfony/archive/refs/heads/session-projet/19-04-22.22-04-22.zip) ou cloner le projet
2. Ouvrir avec VSCode le projet
3. Configurez la base de données dans le fichier `.env`
4. Dans un terminal lancez la commande : `composer install`
5. Dans un terminal lancez la commande : `symfony console doctrine:database:create`
6. Dans un terminal lancez la commande : `symfony console doctrine:schema:update --force`
7. Dans un terminal lancez la commande : `symfony console hautelook:fixtures:load`
8. Dans un terminal lancez la commande : `symfony server:start`

## Aide pour le développement

Lorsque vous serez confrontez à une fonctionalité à développer
vous pouvez suivre cette ordre afin de ne pas vous perdre :

1. Le DTO ou le/les entités
2. Les fixtures
3. Le repository
4. Les Formulaires
5. Le Controller
6. La Vue
