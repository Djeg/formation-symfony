# Le controlleur et les routes

1. Créer le controller « HomeController », lui ajouter la route :

   - "/" : Page d'accueil. Dans cette page d'accueil, retourner une réponse
     avec le text "Page d'accueil"

2. Créer le controller « UserController », lui ajouter les routes suivants :

   - "/connexion": Page de connexion, retourner une réponse avec le text
     "Connexion"
   - "/inscription": Page d'inscrition, retourner une réponse avec le text
     "Inscription" et avec le code de status 501 !

3. Créer le controller « AdvertisementController », lui ajouter les routes suivantes :

   - "/rechercher" : Page de recherche, retourner une réponse avec le text "Rechercher"
   - "/annonces-livre/{id}" : Page d'une annonce, retourner le text "Annonce n°{id}"

> ATTENTION
>
> 1. Suivez bien les conventions de nommage pour les routes (`app_controller_method`)
> 2. Utiliser la console pour générer vos controllers
> 3. BONUS : Utiliser l'option methods afin de limiter les méthodes de chaque ROUTE.
