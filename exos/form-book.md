# Formulaire d'administration des livres

## Créer un formulaire pour l'administration des livres

Grâce à la commande `symfony console make:form`, créer un formulaire
`AdminBookType` attaché à la class `Book`(DTO).

Configurer le formulaire pour afficher les champs de formulaire suivant :

| nom         | type         | options                                         |
| ----------- | ------------ | ----------------------------------------------- |
| title       | TextType     | label: Titre du livre, required: true           |
| price       | MoneyType    | label: Prix du livre, required: true            |
| description | TextareaType | label: Description du livre, required: false    |
| imageUrl    | UrlType      | label: URL de l'image du livre, required: false |
| author      | EntityType   | label: Choix de l'auteur, required: false       |
| categories  | EntityType   | label: Choix des catégories, required: false    |

## Création d'un livre

Dans le controller `Admin/BookController` et dans la méthode `create`,
grace au commande suivante, utiliser le formulaire `AdminBookType` :

```php
// Création du formulaire
$form = $this->createForm(AdminBookType::class);

// Remplie le formulaire avec les données envoyé pour l'utilisateur
$form->handleRequest($request);

// test la validité du formulaire
$form->isSubmitted() && $form->isValid();

// Récupére l'auteur
$author = $form->getData();

// Affiche le HTML
$form->createView();
```

## Mettre à jour un livre

Dans le controller `Admin/BookController` et dans la méthode `update`,
grace au commandes plus haut, utiliser le formulaire `AdminBookType`

CF: Vous pouvez passer à second argument à `createForm` contenant le livre
à modifier :

```php
$form = $this->createForm(AdminBookType::class, $book);
```
