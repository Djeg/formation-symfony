# La Validation

Il est possible en symfony de spécifier des contraintes de validation sur des champs de formulaire. Ces contraintes vont permettre des chose comme :

- Je ne dois pas contenir moins de 6 lettres
- Je doit être supérieur au nombre 2 mais inférieur au nombre 45
- etc ...

Symfony possède tout une liste de contraintes de validation :

[Liste des contraintes](https://symfony.com/doc/current/reference/constraints.html)

## Appliquer des contraintes à un champ de formulaire

Sur chaque champs d'un formulaire nous pouvons utiliser l'options « constraints » et spécifier un tableaux de contraintes :

```php
$builder
    ->add('email', EmailType::class, [
        // On spécifie des contraintes
        'constraints' => [
            new Email(),
            new NotBlank(),
            new Length(['min' => 5]),
        ]
    ])
    ->add('password', PasswordType::class, [
        // On spécifie des contraintes
        'constraints' => [
            new Length([
                'min' => 8
            ]),
            new Regex('/[a-z]+/'),
            new Regex('/[A-Z]+/'),
            new Regex('/[0-9]+/'),
            new Regex('/(\*|\+|\$|%|\?|!|-|@|#|&)+/'),
        ]
    ]);
```
