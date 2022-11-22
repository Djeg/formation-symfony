# Le Query Builder

Lorsque l'on travail avec doctrine, nous utilsons les Repository afin de récupérer des entités contenues dans la base de données. Lorsque l'on utilise la méthode `find`, doctrine s'occupe de faire la bonne requête SQL. Cependant doctrine est un outil très puissant qui nous permet de créer nos propre requêtes.

Pour cela, doctrine utilise un outil nommé « QueryBuilder ». Ce dernier nous permet de compose notre requête à la base de données.

## Utiliser le QueryBuilder dans un Repository

Pour utilise ce query builder il faut se rendre dans un repository. Dès lors nous pouvons ajouter autant de méthodes que l'on souhaite, nommé : les finders.

Voici comment il s'utilise :

```php
public function findBySearchText(string $search): array
{
    // Afin de faire des reqûetes à la base de données il faut
    // tout d'abord créer un query builder :
    //
    // Pour créer ce query, utiliser $this->createQueryBuilder et
    // spécifier un alias de recherche.
    $qb = $this->createQueryBuilder('ad');

    // Afin de faire une condition sur une relation de l'entité Ad (Les livres),
    // nous devons réaliser une jointure. Pour cela nous pouvons utiliser
    // $qb->innerJoin
    // $qb->join
    // $qb->leftJoin
    $qb->leftJoin('ad.book', 'book');

    // Il est possible de rajouter des conditions SQL (WHERE) en
    // utilisant  $qb->andWhere
    //
    // TRES IMPORTANT : Il est formellement interdit et bannie de mettre
    // dans variables diréctement dans un andWhere !!!!!
    $qb->andWhere("ad.title LIKE :search OR book.title LIKE :search");

    // Il est possible de spécifier la valeur d'un paramètre DQL
    // en utilisant $qb->setParameter
    //
    // TRES IMPORTANT : Grâce à ces paramètres doctrine est en capacité
    // de vous protéger de l'injection SQL!!!
    $qb->setParameter('search', "%$search%");

    // Il est possible de limiter le nombre de résultats :
    $qb->setMaxResults(2);

    // Il est aussi possible de trier les résultats :
    $qb->orderBy('ad.updatedAt', 'DESC');

    // Il est possible de spécifier un « offset » :
    $qb->setFirstResult(4);

    // Afin de lancer la requête à la base de données, nous devons le faire
    // 2 étape :
    // 1. Récupére la requête avec : $sql = $qb->getQuery();
    // 2. Lancer la requête : $sql->getResult();
    $data = $qb->getQuery()->getResult();

    // Nous pouvons enchainer la totalité des fonctions :
    return $this->createQueryBuilder('ad')
        ->leftJoin('ad.book', 'book')
        ->andWhere('ad.title LIKE :search OR book.title LIKE :search')
        ->setParameter('search', "%$search%")
        ->setMaxResults(10)
        ->orderBy('ad.updatedAt', 'DESC')
        ->getQuery()
        ->getResult();
}
```
