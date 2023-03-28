<?php

namespace App\Repository;

use App\Entity\PublishingHouse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PublishingHouse>
 *
 * @method PublishingHouse|null find($id, $lockMode = null, $lockVersion = null)
 * @method PublishingHouse|null findOneBy(array $criteria, array $orderBy = null)
 * @method PublishingHouse[]    findAll()
 * @method PublishingHouse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublishingHouseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PublishingHouse::class);
    }

    public function save(PublishingHouse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PublishingHouse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Récupére 5 maisons d'édition triée par date de mise à jour décroissante
     */
    public function findLatest(): array
    {
        // Je créé le query builder
        return $this
            ->createQueryBuilder('pubhouse')
            // Je trie les maisons d'édition
            ->orderBy('pubhouse.updatedAt', 'DESC')
            // Je limite
            ->setMaxResults(5)
            // Je créé la requête SQL
            ->getQuery()
            // Je lance la requête et récupére les maisons d'édition
            ->getResult();
    }

    //    /**
    //     * @return PublishingHouse[] Returns an array of PublishingHouse objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PublishingHouse
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
