# Conection, Profile et Navigation

L'objectif de cet exercice c'est de pouvoir connécté un utilisateur, ainsi que d'éditer son profile et naviguer sur les différentes pages de notre site.

## Générer le système d'authentification

Avec la commande `symfony console make:auth`, générer le système d'authentification en utilisant le login form et le `UserController`.

> N'oublié pas de retoucher la classe Authenticator et de rediriger l'utilisateur vers une de vos pageo

> BONUS : N'héistez pas à déplacer, retoucher le fichier login.html.twig pour qu'il vous corresponde.

## Ajouter des administrateur

Dans votre fichier de fixtures (`fixtures/data.yml`), ajouter un ou plusieurs utilisateur qui posséde le role `ROLE_ADMIN`.

> N'oublier pas de lancer la commande `symfony console ha:fo:li -q --purge-with-truncate` afin de charger les données.

## Gérer les permissions des administrateurs

Pour tout les controlleurs contenant `Admin`, faire en sorte de les rendre uniquement accessible aux utilisateur avec le `ROLE_ADMIN`

## L'édition de profile

1. Commencer par créer un formulaire attaché à un `User` : `ProfilType`
2. Dans le user controlleur faire une route permettant d'éditer l'addresse email de l'utilisateur actuellement connécté (url: `/mon-profile`).
3. Rendre cette page accessible uniquement aux utilisateurs connécté.

## Le menu de navigation

Créer un fichier twug `_menu.html.twig`, placez-y un menu de navigation contenant :

- Se connécter (si l'utilisateur n'est pas connécté)
- Se déconnécter (si l'utilisateur est connécté)
- Les auteurs
- Administration des auteurs (si l'utilisateur est ROLE_ADMIN)
- Administration des maisons d'édition (si l'utilisateur est ROLE_ADMIN)
- Administration des livres (si l'utilisateur est ROLE_ADMIN)

> Ce menu doit apparaître sur toute les pages !
