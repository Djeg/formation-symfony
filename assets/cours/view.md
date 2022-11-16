# La vue et Twig

Symfony utilise un « moteur template » afin de créer des vues.
Ce moteur de template c'est « Twig ».

## Afficher un template dans un controller

Il est possible, dans un controller, de demander à afficher un fichier html twig. Pour cela :

```php
return $this->render('chemin/du/fichier.html.twig', [
  'variable1' => 'John',
  'variable2' => 'Doe',
]);
```

> **ATTENTION**
> Il éxiste un convention de nommage, chaque dossier dans templates représente un controller.
> Chaque fichier twig représente une méthode de controller.

## Utiliser twig

Twig est un petit langage inspiré par Python. Sa syntax est très allégée :

```twig
{# Ceci est un commentaire twig #}

{# affiche le contenue d'une variable #}
<p>Bonjour {{ name }}</p>

{# Affiche un contenue selon certaines condition #}
{% if age > 18 %}
    <p>Vous êtes majeur !</p>
{% else if age <= 4 %}
    <p>Areee Aree Areeeee</p>
{% else %}
    <p>Vous êtes mineur !</p>
{% endif %}

{# boucle sur les éléments d'un tableau #}
{% for name in items %}
    <p>Vous possédez {{ name }} !</p>
{% endfor %}

{#
    Accède à la propriété d'un object:

    ¨ Twig utilise les getters et setters afin d'obtenir
    la propriété d'un object. La commande plus haut éxécute:
    $user->getName(); ¨
#}
Bonjour {{ user.name }} !
```

## L'inclusion

Il est possible d'inclure de petit bout de HTML en utilisant
la fonction twig `include` :

```twig
{# _menu.html.twig #}
<nav>
  <ul>
    <li>Menu</li>
  </ul>
</nav>
```

```twig
{# index.html.twig #}
{{ include('_menu.html.twig') }}
```

## L'héritage

Il est possible d'utiliser une technique bien plus puissante : L'héritage.

C'est la possibilité de reprendre le contenue d'un fichier twig et de réécrire
des parties précises (les block)

Exemple :

```twig
{# base.html.twig #}
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{% block title %}Welcome!{% endblock %}</title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>⚫️</text></svg>">
        {% block stylesheets %}
        {% endblock %}

        {% block javascripts %}
        {% endblock %}
    </head>
    <body>
        {% block body %}{% endblock %}
    </body>
</html>
```

```twig
{# home/index.html.twig #}
{% extends 'base.html.twig' %}

{% block title %}LookBook - Accueil{% endblock %}

{% block body %}
  <h1>Coucou les amis !</h1>

  <p>Hey hey</p>
{% endblock %}
```

## Faire des liens entre les pages !

Pour faire un lien en HTML on utilise la balise : `<a>`. Cette dernière
pour fonctionner à besoin d'un attribut `href` :

```html
<a href="/lien/vers/ma/page">Coucou</a>
```

Le problème : Le contenu de notre HREF, c'est une route ! Nous ne mettons pas les liens diréctement dans la balise a.href. Nous allons plutôt demander à Symfony de générer cette partie pour nous :

```twig
<a href="{{ path('app_adminBook_list') }}">Liste des livres</a>
```

Pour faire des liens entre nos pages, nous utilisons la fonction twig : `path`. Cette fonction, accèpte 1 paramètre : la nom de la route.

**ATTENTION** : Il éxiste des routes qui sont « dynamique » (des routes avec des varaiables) ! Pour ces routes la, il faut spécifier un second paramètre à la fonction `path` avec le contenu des variables :

```twig
<a href="{{ path('app_adminBook_update', { id: book.id }) }}">Mettre à jour</a>
```

## Ajouter des feuilles de styles ou du javascript

**les feuilles de styles et le javascript** se sont des resources **PUBLIC** (qui se range dans le dossier `public`). Vous pouvez ajouter ce que vous voulez dans le répertoire et y accéder comme ceci :

```html
<link rel="stylesheet" href="/style.css" />
```

La balise `link` est généralement ajouté dans le template `base.html.twig` !
