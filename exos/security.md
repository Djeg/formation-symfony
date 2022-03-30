# La Sécurité

## 1. Créer et insérer des utilisateurs

1. Graçe à la commande : `symfony console make:user` généré une class (entité) User.

2. Modifier le fichier `fixtures/data.yml` pour contenir au moins 1 utilisateur.
   Vous pouvez utiliser la commande `symfony console security:hash-password` pour crypter
   un mot de passe. Attention, le character `$` doit être échapé avec : `\$`. Vous
   pouvez vous inspirez de [ce fichier](../fixtures/data.yml).

3. Insérer les utilsateur en base de données avec les commandes:

- `symfony console doctrine:schema:update --force`
- `symfony console hautelook:fixtures:load`

## 2. Créer le système d'authentification

1. Graçe à la commande `symfony console make:auth` généré tout le system
   d'authentification via un formulaire de login
2. Dans la class `Security/*******Authenticator` retoucher la méthode
   `onAuthenticationSuccess` pour rediriger vers la page d'accueil.
3. Essayer de vous connécté (vous pouvez personnaliser le template twig)

## 3. Faire un formulaire d'inscription

Dans le controller `SecurityController` ajouter une methode `signIn` avec la
route `/inscription` qui affiche le formulaire suivant :

| nom      | type         | valeur par défaut |
| -------- | ------------ | ----------------- |
| email    | EmailType    | -                 |
| password | RepeatedType | -                 |

En consultant la documentation :

```php
public function index(UserPasswordHasherInterface $passwordHasher)
{
    // ... e.g. get the user data from a registration form
    $user = new User(...);
    $plaintextPassword = ...;

    // hash the password (based on the security.yaml config for the $user class)
    $hashedPassword = $passwordHasher->hashPassword(
        $user,
        $plaintextPassword
    );
    $user->setPassword($hashedPassword);

    // ...
}
```

Lien de la documentation : https://symfony.com/doc/current/security.html#registering-the-user-hashing-passwords

## 3. Restreindre l'acces à l'administration

En utilisant l'attribut PHP : `IsGranted` ([example](../src/Controller/Admin/BookAdminController.php))
restreindre l'accès à tout l'administration uniquement pour les utilisateurs
avec le `ROLE_ADMIN`.

Dans le fichier `fixtures/data.yml` ajouter un utilisateur de votre choix
avec le roles : `ROLE_ADMIN`.

## 4. Lien vers l'administration

En utilisant la fonction twig `is_granted`, faire en sorte
que si je suis connécté en tant qu'administrateur, un lien
vers la liste des livres de l'admin doit apparaitre
dans le menu.

## 5. Le profile

Dans le controller `SecurityController` ajouter une méthode `profil` avec
la route `/mon-profile`.

Cette méthode doit être uniquement accessible au utilisateur connécté
(`IsGranted('ROLE_USER')`).

Cette page doit proposer le formulaire suivant:

| nom      | type         | Requis |
| -------- | ------------ | ------ |
| email    | EmailType    | non    |
| password | PasswordType | non    |

Un fois le formulaire validé, les informations de l'utilisateur doivent
changé. ATTENTION : L'utilisateur doit être redirigé vers la page
de connexion.

## 6. Les liens

En utilisant la variable twig `app.user` ainsi que la fonction twig
`is_granted` :

Dans le menu, si je ne suis pas connécté et que je clique sur le logo
"User", alors je dois être redirigé vers la pade de connexion.

Dans la page de connexion, un lien vers la page de création de compte
doit être disponible.

Dans le menu, si je suis connécté et que je clique sur le logo
"User", alors je dois me rendre sur la page de mon profile.

Dans le menu, si je suis connécté, afficher une lien pour me
déconnécter.
