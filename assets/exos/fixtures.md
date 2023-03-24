# Les Fixtures

L'objectif de cet exercice est de remplir une base de données.

## Reprenez le code de la formation

Soit en copiant et collant les dossier `src` et `templates`, soit en suivant les instruction d'installation.

## Installer le bundle `alice`

Utiliser la commande :

```bash
symfony composer require hautelook/alice-bundle
```

## Créer votre fichier de fixtures

Dans le dossier `fixtures`, ajouter un fichier `data.yml`

## Générer les données de votre base de données

Générer environ 200 auteurs et 200 maisons d'éditions

Générer environ 500 livres tous attaché à un auteur et une maison d'édition :)

> Vous pouvez charger les fixtures dans votre base de données en utilisant la commande :
>
> ```
> symfony console ha:fi:lo -q --purge-with-truncate
> ```
