# Rechercher des annonces

L'objectif de cette exercice est de faire une page de recherche complete et fonctionnel pour notre site.

## 1. Le DTO

Créer une class DTO « AdSearchCriteria ». Cette class posséde les propriétés suivante :

| nom        | type    | valeur par défaut |
| ---------- | ------- | ----------------- |
| searchText | ?string | null              |
| genre      | ?string | null              |
| author     | ?User   | null              |
| minPrice   | ?float  | null              |
| maxPrice   | ?float  | null              |
| orderBy    | string  | "createdAt"       |
| direction  | string  | "DESC"            |
| limit      | int     | 21                |
| page       | int     | 1                 |

## 2. Le formulaire de recherche

Créer un formulaire de recherche « AdSearchType » attaché au DTO créé plus haut.

Vous pouvez personnaliser les champs du formulaire et aussi ne pas oublier d'ajouter un bouton d'envoie.

N'oubliez pas de mettre les options nescessaire à un formulaire recherche !

## 3. Le repository

Créer un « finder » (**findBySearchCriteria**) dans le « AdRepository ».
Cette méthode accèpte un paramétre : une instance de « App\DTO\AdSearchCriteria » :

```php
public function findBySearchCriteria(AdSearchCriteria $criteria): array
{
  // ex : récupérer la page
  $criteria->page;

  // ex : récupération du trie
  $criteria->orderBy

  // Il vous faudra : Créer un query builder !

  // BONUS : Pour calculer le offset (setFirstResult du query builder)
  // voici la petite formule mathématique :
  // (page - 1) * limit
}
```

## 4. Le controller

Ajouter une méthode dans le « HomeController » nommé : « search ». Attacher la route "/rechercher".

Dans cette méthode :

```php
// 1. Créer le formulaire de recherche avec des critéres vides
$this->createForm(AdSearchType::class, new AdSearchCriteria());

// 2. Remplir le formulaire avec la requête

// 3. Récupérer les critéres de recherche et les envoyer au repository !

// 4. afficher la page twig !
```

## 5. La Vue

En reprenant le même « design » que la page d'accueil afficher le formulaire
de recherche et ses résultats.
