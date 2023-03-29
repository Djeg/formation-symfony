<?php

namespace App\Repository;

use App\DTO\AuthorSearchCriteria;
use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 *
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    public function save(Author $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Author $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Récupére tout les auteurs correspondant aux critéres
     * de recherche
     */
    public function findAllByCriteria(AuthorSearchCriteria $criteria): array
    {
        // Je créé le query builder
        $qb = $this->createQueryBuilder('author');

        // Je limite mes résultats de recherche
        $qb->setMaxResults($criteria->limit);

        // Je réalise une pagination
        $qb->setFirstResult($criteria->limit * ($criteria->page - 1));

        // Si l'utilisateur à spécifié un titre
        if ($criteria->title) {
            // on réalise la recherche par titre
            $qb
                ->andWhere('author.title LIKE :title')
                ->setParameter('title', "%{$criteria->title}%");
        }

        // Je récupére la requête ainsi que les résultats (des auteurs)
        return $qb->getQuery()->getResult();
    }

    /**
     * Récupére 10 auteurs triéé par date de mise à jour décroissant
     */
    public function findLatest(): array
    {
        // Je créé le query builder
        return $this
            ->createQueryBuilder('author')
            // Je trie par date de mise à jour décroissante
            ->orderBy('author.updatedAt', 'DESC')
            // Je limite mes résultats
            ->setMaxResults(10)
            // Je créé la requête SQL
            ->getQuery()
            // Je récupére les livres
            ->getResult();
    }

    //    /**
    //     * @return Author[] Returns an array of Author objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Author
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
