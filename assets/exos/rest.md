# Concevoir notre api pour « LookBook »

Le principe de l'api est de proposer des « endpoints » (URI) afin que notre application soit utilisable sur des téléphones :)

Le but de l'exercice est simple, des propositions vous seront faites et vous devrez données l'uri, l'action et le type :

exemple :

Poposition :

**Je veux récupérer les 10 derniers livre**

Solution :

| action | uri (endpoint)                                   | type       |
| ------ | ------------------------------------------------ | ---------- |
| GET    | /books?limit=10&orderBy=createdAt&direction=DESC | Collection |

> Attention : Il peut éxister énormement de solutions différentes. C'est à vous de trouver celle qui vous semble le plus logique.

## Les propositions

1. Je veux récupérer les 25 livres les plus chères
2. Je veux récupérer mes données personnel
3. Je veux créer un nouveau livre
4. Je veux modifier le livre n°3 de l'auteur n° 10
5. Je veux supprimer mon panier
6. Je veux récupérer l'auteur du livre avec l'id 5
7. Je veux modifier l'email de l'utilisateur 14
8. Je veux récupérer les 25 derniers commentaires du livre n°9
9. Je veux créer un nouveau commentaire sur le livre 12
10. Je veux « liker » le commentaire n° 23 sur le livre n°9
