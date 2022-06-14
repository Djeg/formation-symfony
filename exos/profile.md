# Modifier mon profil

## Ajouter des champs dans l'entité User

Graçe à la commande `symfony console make:entity`, modifier
l'entité User et ajouter les champs suivant :

| nom         | type   | nullable |
| ----------- | ------ | -------- |
| imageUrl    | string | yes      |
| description | text   | yes      |
| firstname   | string | yes      |
| lastname    | string | yes      |

> n'oubliez pas de mettre à jour votre base de données avec la commande
> `symfony console d:s:u --force`

## Création du formulaire de modification de profile

Graçe à la commande `symfony console make:form` générer un formulaire
`ProfileType` attaché à la class `User`. Ce formulaire doit posséder
les champs suivant :

| nom         | type         | options         |
| ----------- | ------------ | --------------- |
| email       | EmailType    | required: true  |
| imageUrl    | UrlType      | required: false |
| description | TextareaType | required: false |
| firstname   | TextType     | required: false |
| lastname    | TextType     | required: false |

## Page d'édition du profile

Dans le controller `SecurityController`, ajouter une méthode
`myProfile` attaché à la route : `/mon-profile`.

Graçe à la méthode `$this->getUser()` ainsi qu'à l'attribut : `#[IsGranted('...')]`
rendre cette page accessible qu'aux utilisateur avec le `ROLE_USER`. Dans cette
page afficher et traiter le formulaire d'édition de profile :).

## Retoucher le menu

Dans le fichier `templates/base.html.twig`, ajouter un lien vers 'Mon Profil' seulement
si l'utilisateur est connécté !
