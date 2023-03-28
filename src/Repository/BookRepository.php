<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function save(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Voici un exemple de « finder ». C'est une méthode qui récupére
     * des données (ici des livres) de manière « filtré »
     */
    public function findByExemple(): array
    {
        // Le première étape afin de réaliser une requête à notre
        // base de données c'est de créer un query builder.
        // Le query builder, permet de générer des requêtes intelligente.
        // Il porte un « alias » permettant d'identifier notre entité dans la
        // base de données
        $qb = $this->createQueryBuilder('book');

        // À partir de ce query builder nous pouvons construire et enchainer
        // des filtres pour nos requêtes :
        $qb
            // Il est possible de faire des conditions WHERE :
            ->andWhere('book.title = "Harry Potter"')
            // Il est possible de faire des conditions WHERE, avec un paramètre nommé
            // (:title)
            ->andWhere('book.title LIKE :title')
            // Ces paramètres nous permette d'injécter des variables PHP dans nos requêtes
            // afin d'éviter les attaques « d'injection SQL ».
            // Nous pouvons spécifier la valeur d'un paramètre nommé :
            ->setParameter('title', '%Harry%')
            // Il est possible de trier les résultats avec `orderBy` :
            ->orderBy('book.createdAt', 'DESC')
            // Il est aussi possible de limiter les résultats avec le fonction `setMaxResult` :
            ->setMaxResults(5)
            // Il est aussi possible de créer un « offset », c'est à dire de commencer à partir
            // du n°ieme résultat :
            ->setFirstResult(2)
            // Il est aussi possible de réaliser des jointures ....  C'est à dire joindre 2 objets
            // PHP (2 entitès) :
            ->leftJoin('book.author', 'author')
            // Maintenant que la jointure est faite nous pouvons réaliser des conditions sur les auteurs :
            ->andWhere('author.title LIKE :authorTitle')
            ->setParameter('authorTitle', '%J.K%');

        // Pour récupérer les résultats, il faut tout d'abord générer la requête SQL :
        $sql = $qb->getQuery();

        // Maintenant pour lancer la requêtes et récupérer les livres :
        return $sql->getResult();
    }

    //    /**
    //     * @return Book[] Returns an array of Book objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Book
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
