# La page d'accueil

Vous pouvez aider de l'example suivant dans le [BookRepository](../src/Repository/BookRepository.php#L42)

## Création d'un page d'accueil

Créer un controller : `HomeController` dans la dossier `Front` du dossier
controller.

Dans ce controller, ajouter un méthode "home" qui récupére les 20 derniers
livres trié par prix décroissant. Afficher ces livres dans une un template
twig html en suivant les conventions de nommages (Le CSS, HTML est libre !!!).

> Il vous faudra utiliser le `BookRepository` et ajouter un "finder" de votre
> choix

## Ajouter les catégories

Dans la liste des livres de la page d'accueil, faire en sorte d'afficher les
catégories de chaque livres.
