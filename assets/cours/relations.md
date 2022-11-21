# Les relations avec Doctrine

## La théorie

Il éxiste 3 types de relations entre nos entités :

- **OneToOne** : Un vers un, soit une entité est lié à une autre entité
- **OneToMany/ManyToOne** : Un vers plusieurs, soit une entité est lié à plusieurs entités
- **ManyToMany** : Plusieurs vers plusieurs, soit plusieurs entités sont liées à plusieurs entités

## Générer une relation

Afin de générer l'un de ces relations plus haut, il faut utiliser la commande :

```bash
# sans docker
symfony console make:entity <nomEntity>
# avec docker
bin/sf console make:entity <nomEntity>
```

Il faut nommer la propriété qui contiendra la relation ainsi que choisir le type de relation :). Pour cela vous pouvez vous laisser guider, attention à bien tout lire.

> **ATTENTION**
> La base de données ne se met pas à jour automatiquement il faut utiliser la commande `symfony console doctrine:schema:update --force`

## Gérer une relation dans un formulaire

Symfony à mis en place un type de champs : **`EntityType`**. Ce dernier permet de séléctionner parmis des entitès présente en base de données :

```php
$builder->add('users', EntityType::class, [
    // Quelle entité est-ce que je dois séléctionner ?
    'class' => User::class,

    // La propriété de l'utilisateur qui s'affichera à l'ecran
    'choice_label' => 'email',

    // Options permettant de gérer l'affichage et la « multiplicité »
    // 'multiple' => true,
    // 'expanded' => true,
]);
```
