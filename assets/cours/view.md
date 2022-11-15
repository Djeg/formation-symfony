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
