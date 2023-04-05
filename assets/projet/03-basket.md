# Le panier

L'objectif de cette partie est de pouvoir consulter, ajouter et supprimer des lires de notre panier.

## 1. Entité

Avec la commande `symfony console make:entiy`, créé une entité `Basket` avec les champs suivant :

| champ  | type     |
| ------ | -------- |
| user   | relation |
| livres | relation |

## 2. Les fixtures

Faire en sorte que **tout les utilisateurs de l'application** possède un panier (de base ce panier est vide) !

> **INDICE** : Il est aussi possible d'utiliser un constructeur ...

## 3. Le controller

### 1. La méthode `show`

Créer une route `/mon-panier`, accessible uniquement aux utilisateurs connécté. Dans cette route, afficher les livres présent dans le panier de l'utilisateur connécté.

> **BONUS** : Trouver une solution afin de calculer le prix total d'un panier

> **BONUS** : Ajouter un petit menu pour accéder au panier.

### 2. La méthode `add`

Créer une route `/mon-panier/ajouter/{id}` accessible uniquement aux utilisateurs connécté. Dans cette route, récupérer le livre avec son identifiant et ajouter le au panier de l'utilisateur connécté.

> Une fois ajouté, redirigé vers la page `/mon-panier`

> **ATTENTION** : On ne peut pas ajouter 2 fois le même livre !

> **BONUS** : Ajouter un bouton `ajouter au panier` sur tout les livres de la page d'accueil ainsi que la page de recherche

### 3. La méthode `remove`

Créer une route `/mon-panier/supprimer/{id}` accessible uniquement aux utilisateurs connécté. Dans cette route, récupérer le
livre avec son identifiant et supprimer le du panier.

> Une fois supprimé, redirigé vers la page `/mon-panier`
