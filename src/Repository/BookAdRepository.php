<?php

namespace App\Repository;

use App\DTO\BookAdCriteria;
use App\Entity\BookAd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BookAd>
 *
 * @method BookAd|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookAd|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookAd[]    findAll()
 * @method BookAd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookAdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookAd::class);
    }

    public function save(BookAd $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BookAd $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Récupére les 25 derniers livres
     */
    public function findLatest(): array
    {
        return $this
            ->createQueryBuilder('book')
            ->setMaxResults(25)
            ->orderBy('book.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Recherche des livres en fonction de critères de recherche
     */
    public function findAllByCriteria(BookAdCriteria $criteria): array
    {
        // Création du query builder, paginé
        $qb = $this
            ->createQueryBuilder('book')
            ->setMaxResults($criteria->limit)
            ->setFirstResult($criteria->limit * ($criteria->page - 1))
            ->orderBy("book.{$criteria->orderBy}", $criteria->direction);

        // Si il y a une recherche par titre
        if ($criteria->title) {
            $qb
                ->andWhere("CONCAT(book.title, CONCAT(' ', CONCAT(book.author, CONCAT(' ', book.publishingHouse)))) LIKE :title")
                ->setParameter('title', "%{$criteria->title}%");
        }

        // On demande un trie par les états
        if ($criteria->states) {
            $qb
                ->andWhere('book.state IN (:states)')
                ->setParameter('states', $criteria->states);
        }

        // Trie par prix minimum
        if ($criteria->minPrice) {
            $qb
                ->andWhere('book.price >= :minPrice')
                ->setParameter('minPrice', $criteria->minPrice);
        }

        // Trie par prix maximum
        if ($criteria->maxPrice) {
            $qb
                ->andWhere('book.price <= :maxPrice')
                ->setParameter('maxPrice', $criteria->maxPrice);
        }

        // Trie par user
        if ($criteria->user) {
            $qb
                ->leftJoin('book.user', 'user')
                ->andWhere("CONCAT(user.email, CONCAT(' ', CONCAT(user.firstname, CONCAT(' ', user.lastname)))) LIKE :user")
                ->setParameter('user', "%{$criteria->user}%");
        }

        // Je retourne les résultats
        return $qb->getQuery()->getResult();
    }

    //    /**
    //     * @return BookAd[] Returns an array of BookAd objects
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

    //    public function findOneBySomeField($value): ?BookAd
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
