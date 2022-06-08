# Formulaire pour les auteurs

## Créer un formulaire pour l'administration des auteurs

Grâce à la commande `symfony console make:form`, créer un formulaire
`AdminAuthorType` attaché à la class `Author`(DTO).

Configurer le formulaire pour afficher les champs de formulaire suivant :

| nom         | type         | options                                            |
| ----------- | ------------ | -------------------------------------------------- |
| name        | TextType     | label: Nom de l'auteur, required: true             |
| description | TextareaType | label: Description de l'auteur, required: false    |
| imageUrl    | UrlType      | label: URL de l'image de l'auteur, required: false |

## Création d'un auteur

Dans le controller `Admin/AuthorController` et dans la méthode `create`,
grace au commande suivante, utiliser le formulaire `AdminAuthorType` :

```php
// Création du formulaire
$form = $this->createForm(AdminAuthorType::class);

// Remplie le formulaire avec les données envoyé pour l'utilisateur
$form->handleRequest($request);

// test la validité du formulaire
$form->isSubmitted() && $form->isValid();

// Récupére l'auteur
$author = $form->getData();

// Affiche le HTML
$form->createView();
```

## Mettre à jour un auteur

Dans le controller `Admin/AuthorControlelr` et dans la méthode `update`,
grace au commandes plus haut, utiliser le formulaire `AdminAuthorType`

CF: Vous pouvez passer à second argument à `createForm` contenant l'auteur
à modifier :

```php
$form = $this->createForm(AdminAuthorType::class, $author);
```
