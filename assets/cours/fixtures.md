# Les fixtures Alice

Lorsque l'on travail sur une application symfony, il est important de pouvoir partager les "même données" entre les différents dévelloppeurs. Cela permet de mieux identifier et corriger les bugs et aussi faciliter l'installation.

## Installation de alice pour symfony

Alice est une librairie php pouvant s'utiliser avec d'autres frameworks (comme « Laravel » par exemple). Il éxiste 2 librairie :

- [La librairie Alice](https://github.com/nelmio/alice)
- [L'extension symfony (bundle) Alice](https://github.com/theofidry/AliceBundle)
- [Faker, permet de générer de fausse données](https://fakerphp.github.io/formatters/)

Pour installer tout ça, une seule commande :

```bash
# Sans docker
symfony composer require hautelook/alice-bundle

# Avec docker
bin/sf composer require hautelook/alice-bundle
```

Cette commande install « Alice » et créer le répertoire « fixtures » qui contiendra nos fixtures.

## Écrire des fixtures

Les fixtures se trouvent dans le dossier « fixtures » et utilise le format « yaml ». Afin de créer nos premières fixtures, il suffit tout simplement de créer un fichier du nom de votre choix mais se terminant par l'extension « .yaml » (ou « .yml »).

Un fichier de fixtures s'organise comme [ceci](../../fixtures/data.yaml)

## Insérer les fixtures dans la base de données

Maintenant que notre fichier de fixtures est créé, il suffit de lancer la commande :

```bash
# Sans docker
symfony console hautelook:fixtures:load -q --purge-with-truncate

# Avec docker
bin/sf console ha:fi:lo -q  --purge-with-truncate
```

> **ATTENTION**
> Lorsque l'on insére les fixtures, votre base de données s'efface totalement !
