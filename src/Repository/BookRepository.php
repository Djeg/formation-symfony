<?php

namespace App\Repository;

use App\DTO\BookSearchCriteria;
use App\Entity\Book;
use App\Repository\Helper\BuildPagination;
use App\Repository\Helper\BuildSort;
use DateTime;
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
    use BuildPagination;
    use BuildSort;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function save(Book $entity, bool $flush = false): void
    {
        $entity->setUpdatedAt(new DateTime());

        if (!$entity->getCreatedAt()) {
            $entity->setCreatedAt(new DateTime());
        }

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
     * Récupére tout les livres en fonction de critéres de recherche
     */
    public function findAllBySearchCriteria(BookSearchCriteria $criteria): array
    {
        // Création d'un query builder
        $qb = $this->createQueryBuilder('book');

        // Pagination & Trie des livres
        $this
            ->buildSort($qb, 'book', $criteria)
            ->buildPagination($qb, $criteria);

        // La recherche par text
        if ($criteria->searchText) {
            $qb
                ->andWhere("CONCAT(book.title, ' ', book.description) LIKE :searchText")
                ->setParameter('searchText', $criteria->searchText);
        }

        // La recherce par genre
        if ($criteria->genre) {
            $qb
                ->andWhere('book.genre = :genre')
                ->setParameter('genre', $criteria->genre);
        }

        // On retourne les résultats
        return $qb->getQuery()->getResult();
    }
}
