# Gérer les autorisation

## 1. Gérer les controller admin

En utilisant l'attribut `isGranted`, faire en sorte que les controller commencant par `Admin` ne soit disponible qu'au `ROLE_ADMIN`.

> Vous ouvez ajouter dans les fixtures un admin afin de tester

## 2. Le menu

En utilisant `app.user` ainsi que la fonction twig `is_granted` faire en sorte que :

- Si je suis non connécté, le menu doit afficher les liens suivant : `accueil`, `Rechercher`, `Inscription`, `Connexion`

- Si je suis connécté en tant que `ROLE_uSER` alors afficher : `accueil`, `Rechercher`, `Deconnexion`

- Si je sui connécté en tant que `ROLE_ADMIN` alors afficher : `accueil`, `Rechercher`, `Deconnexion`, `Admin` (redirige vers l'une des listes de l'administration)
