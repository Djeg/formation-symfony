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

    public function add(Book $entity, bool $flush = false): void
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

    public function findAllByTitleDesc(): array
    {
        $min = 22.3;
        $qb = $this->createQueryBuilder('book');

        return $qb
            ->andWhere('book.price >= :minimum')
            ->setParameter('minimum', $min)
            ->orderBy('book.title', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findAllOrderedByPrice(): array
    {
        $qb = $this->createQueryBuilder('book');

        return $qb
            ->orderBy('book.price', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }

    public function findAllByCategory(int $id): array
    {
        $qb = $this->createQueryBuilder('book');

        return $qb
            ->orderBy('book.price', 'DESC')
            ->leftJoin('book.categories', 'category')
            ->andWhere('category.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Book[] Returns an array of Book objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('book')
    //            ->andWhere('book.title = "Harry Potter"')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult();
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
