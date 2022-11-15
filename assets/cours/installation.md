# Installation d'un projet symfony

## Prérequis

1. Une version récente de php en ligne de commande (MAMP)
2. [Composer, qui permet d'installer des librairie et de mettre en place l'autoload](https://getcomposer.org/doc/00-intro.md)
3. [Symfony CLI, l'utilitaire symfony](https://symfony.com/download)
4. Une base de données MySQL (MAMP)

## Vous devez créer un tout nouveau projet

Pour créer un tout nouveau projet symfony, il faut utiliser une ligne de commande :

```
symfony new --webapp nomDuProjet
```

## Vous devez un projet dèja éxistant

Pour un projet éxistant, il faut tout d'abord le cloner en ligne de commande :

```
git clone https://url-du-projet-git.com
```

## Configuration du projet

Avec VSCode, il faut configurer le projet en utilisant le fichier `.env`

## Créer la base de données

Pour continuer, il vous faudra créer votre base de données :

```
symfony console doctrine:database:create
```

## Démarrer le serveur symfony

Pour démarrer un serveur symfony :

```bash
symfony server:start
# Vous pouvez aussi personnaliser le port du server
symfony server:start --port=5656
```

> **ATTENTION**
> Les commandes symfony doivent impérativement être lancé dans le bon
> répertoire : **à la racine du projet !!**
