# Le Panier

Vous retrouverez le schèma de la base de données juste
[ici](../doc/UML%20Projet%20Book%20Sell.png)

## 1. La base de données

Avec la commande symfony : `symfony console make:entity` créez une entité
`Basket` avec les champs suivant :

| nom   | type                            |
| ----- | ------------------------------- |
| user  | relation (OneToOne vers User)   |
| books | relation (ManyToMany vers Book) |

Mettre à jours la base données avec la commande `symfony console doctrine:schema:update --force`.

Graçe au constructeur de la class `User`, faire en sorte de rajouter un nouveau
panier à chaque création de user.

## 2. Lister le panier

Dans le `SecurityController` ajouter une method `basket` avec la route :
`/mon-panier`.

Lui attacher une page html qui liste tout les livres présent dans mon panier.
(indice: `app.user` retourne l'utilisateur connécté dans un template twig ... `app.user.basket` ?).

Si la panier est vide afficher "Votre panier est vide".

Ajouter à la fin de la liste le total du prix de tout les livres contenus
dans le panier (indice: vous pouvez ajouter votre propre méthode dans la class `Basket` ...).

Dans le menu, ajouter un lien vers cette page.

## 3. Ajouter au panier

Dans le controller `SecurityController` ajouter une méthode `addBasket` avec la route :
`/mon-panier/{id}/ajouter`.

Faire en sorte d'ajouter le livre avec l'identifiant donné dans le panier
de l'utilisateur connécté. (indice: `$this->getUser()` retourne l'utilisateur
connécté dans un controller).

Dans la page d'un live, ajouter un lien `Ajouter au panier` qui ajoute le livre
au panier.

## 4. Supprimer du panier

Dans le controller `SecurityController` ajouter une méthode `removeBasket` avec la route :
`/mon-panier/{id}/supprimer`.

Faire en sorte de supprimer le livre avec l'identifiant donné dans le panier
de l'utilisateur connécté. (indice: `$this->getUser()` retourne l'utilisateur
connécté dans un controller).

Dans la page du panier, ajouter un lien `Supprimer du panier` qui supprime un livre
du panier.
