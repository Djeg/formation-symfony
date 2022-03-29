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
