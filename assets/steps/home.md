# Mettre en place une page d'accueil

Dans cette étape nous allons mettre en place un jolie page d'accueil pour l'application. Il vous faudra créer l'entité RealProperty. Ne faite pas encores les relations si vous n'en avez pas besoin.

# Etape 1 - Le Model

Afin de mener à bien cette page d'accueil il vous faut créer l'entité `RealProperty` comme indiqueé sur le schèma de la base de données :)

> Indice : la commande `make:entity` peut s'avérer très utile !

> Il vous faudra aussi créer l'entité Address, car une propriété sans adresse n'as pas vraiment de sens ;)

# Etape 2 - Les Fixtures

Grâce au fichier de fixtures `fixtures/data.yml`, ajouter une 20aines de propriétés à vendre !

# Etape 3 - Le Controller

Créer un controller `Front\HomeController` et lui ajouter une route `/` correspondant à la page d'accueil.

Dans ce controller, utiliser le `RealPropertyRepository` afin de récupérer les 10 dernières propriétés à vendre !

Finalement, afficher le template twig de la page d'accueil

> Attention à bien répécter les conventions de nommage

> Attention à bien données la liste des propriétés à vendre à votre template

## Etape 4 - Twig et Design

Afin de bien séparer les éspaces de l'application, commencé par créer un fichier de base pour le frontend (ex: `templates/front.html.twig`) qui hérite de `base.html.twig`. Ce dernier nous servira de base pour tout l'espace public de l'application.

On vous aidant des design [figma](https://www.figma.com/file/zIfLkXWzlZ2JGbld7rBDTe/PrestigImmo?node-id=0%3A1&t=XdLcUPBxjeFP9ilV-1) essayer de reproduire cette page d'accueil en utilisant HTML et CSS :)

> Vous pouvez insérer la balise suivante afin de pouvoir utiliser les icones « font awesome » :
>
> ```html
> <link
>   rel="stylesheet"
>   href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
>   integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
>   crossorigin="anonymous"
>   referrerpolicy="no-referrer"
> />
> ```

> Vous pouvez aussi utiliser google fonts afin de récupérer la police d'écriture de l'application. Elles sont au nombre de 2 :)
