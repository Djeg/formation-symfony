# Instalation d'un projet avec docker

Dans ce projet, pour installer la totalité de l'application
avec docker :

1. Cloner l'application `git clone --branch session-projet/04-04-23/07-04-23 https://github.com/Djeg/formation-symfony`
2. À la racine du projet lancer la commande : `bin/start`

## Petite note

Avec docker, si on utilise la console symfony sans docker, alors
c'est la version de php installé sur votre machine qui sera utilisé.

Afin d'utiliser la version de php de docker, pour toutes commande
symfony utilisé :

```
bin/sf
```

## Arréter l'application

Pour arréter l'application :

```
bin/stop
```
