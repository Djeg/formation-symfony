# Mettre en ligne son application avec Heroku

Heroku c'est système d'hébergement « Virtualisé » gratuit et utilisé par un très grand nombre de développeur. Il est diréctement connécté à GitHub, il est gratuit (jusqu'a certains niveaux), il s'utilise en ligne de commande, il est simple et surtout il supporte TOUT les langages de programmation actuel.

Heroku est développé par la même équipe que GitHub.

Son site officiel : [https://www.heroku.com](https://www.heroku.com)

## Créer un compte avec Heroku

La première étape pour mettre son application en ligne est de créer son compte Heroku.

Ensuite il vout faudra l'utilitaire en ligne de commande : [https://devcenter.heroku.com/articles/heroku-cli](https://devcenter.heroku.com/articles/heroku-cli)

Vous pouvez vous assurez de l'installation d'heroku en tapant la commande :

```bash
heroku
```

## Connécter son terminal à héroku

Pour connécter votre ordinateur (votre terminal) à heroku, il suffit de rentrer la commande :

```bash
heroku login
```

## L'application Heroku

Maintenant que nous avons un compte et que nous somme connécté à heroku, il est possible de créer une application. L'application ça peut-être n'importe quel programme, codé en n'importe quelle langage. Dans notre cas, nous allons configurer une application Symfony.

Il suffit de lancer la commande :

```
heroku create
```

## Installer une base de données mysql dans l'application

Pour installer des « dynos » (des adddons, des programmes ...) il faut obligatoirement spécfier dans votre compte heroku, des informations de carte bleu. Nous allons avoir besoin d'un « dyno » : « ClearDB » (une base de données MySQL compatible avec heroku)

```bash
heroku addons:create cleardb:ignite
```

## Configurer Heroku pour Symfony

> Vous retrouverez des instructions plus compléte sur la documentation officiel : [https://devcenter.heroku.com/articles/deploying-symfony4](https://devcenter.heroku.com/articles/deploying-symfony4)

### Installer le support sur server web Apache

Heroku, utilise afin de mettre en ligne notre application symfony, un serveur HTTP nommé : « Apache ». Pour installer tout ce qu'il faut pour que notre application soit utilisé par apache, il suffit de lancer la commande :

```bash
# Sans docker
composer require symfony/apache-pack
# Avec docker
bin/sf composer require symfony/apache-pack
```

### Créer le « Procfile »

Le « Procfile » c'est un petit fichier, expliquant à heroku comment mettre en ligne notre application. On parle de « recette de déploiement » :

```bash
echo 'web: heroku-php-apache2 public/' > Procfile
git add Procfile
git commit -m "Procfile"
```
