## Correction Interactive Calculatrice

Dans se fichier vous retrouverez toutes les étapes de la correction
interactive de la calculatrice.

## 1. Mise en place

1. Choisir un dossier et de s'y rendre avec un terminal récent (powershell, git bash etc ...).

> Astuce : Vous pouvez utiliser les commande `ls`, `pwd` et `cd` afin de naviguer
> dans votre ordinateur via votre terminal.

2. Lancer la commande `symfony new --webapp nom-du-projet` afin de créer un nouveau
   projet symfony :

![Symfony new](./img/symfony-new.png)

3. Ouvrir VSCode dans le projet tout juste créé

> Astuce : Vous pouvez utiliser `cd` pour déplacer dans le projet tout juste
> créé et lancer la commande `code .`.

## 2. Organisation

Un projet contient 3 dossiers à connaître par coeur :

![sf orga](./img/sf-orga.png)

## 3. Controller le serveur

Pour afficher le site internet symfony que nous venons de créer,
il faut démarrer le server symfony. Pour cela vous pouvez
utiliser le terminal de VSCode et lancer la commande suivante :

```
symfony server:start
```

> Astuce 1 : Pour arréter le serveur, utiliser la combinaison de
> touche : <Ctrl-C>

> Astuce 2 : Vous pouvez aussi arréter le serveur depuis un autre terminal
> en utilisant la commande `symfony server:stop`

> Astuce 3 : VOUS NE POUVEZ PAS LANCER DE COMMANDE À L'INTÉRIEUR
> DU SERVEUR SYMFONY

Une fois cette commande lancé, symfony démarre un serveur logique HTTP sur
votre machine (`127.0.0.1`) sur un port disponible (par défaut le port `8000`).
Ainsi pour accéder au site internet symfony il suffit de rentrer l'addresse suivante :

```
http://127.0.0.1:8000
```

> ATTENTION : Le port peut varier, ce n'est pas forcèment le port 8000
