<?php

namespace App\Repository;

use App\DTO\AddressSearchCriteria;
use App\Entity\Address;
use App\Repository\Helper\BuildPagination;
use App\Repository\Helper\BuildSort;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Address>
 *
 * @method Address|null find($id, $lockMode = null, $lockVersion = null)
 * @method Address|null findOneBy(array $criteria, array $orderBy = null)
 * @method Address[]    findAll()
 * @method Address[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressRepository extends ServiceEntityRepository
{
    use BuildPagination;
    use BuildSort;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Address::class);
    }

    public function save(Address $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Address $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Création d'un finder personalisé afin de récupérer des adresses
     * en fonction de critéres de recherche.
     * 
     * @see AddressSearchCriteria
     */
    public function findAllBySearchCriteria(AddressSearchCriteria $criteria): array
    {
        // Création du query builder
        $qb = $this->createQueryBuilder('address');

        // Mise en place de la pagination et du trie :
        $this
            ->buildPagination($qb, $criteria)
            ->buildSort($qb, 'address', $criteria);

        // La recherche par search text
        if ($criteria->searchText) {
            $qb
                ->andWhere('CONCAT(address.street, ", ", address.city, ", ", address.country) LIKE :searchText')
                ->setParameter('searchText', "%{$criteria->searchText}%");
        }

        // La recherche par utilisateur
        if ($criteria->user) {
            $qb
                ->leftJoin('address.user', 'user')
                ->andWhere('user.id = :userId')
                ->setParameter('userId', $criteria->user);
        }

        return $qb->getQuery()->getResult();
    }

    //    /**
    //     * @return Address[] Returns an array of Address objects
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

    //    public function findOneBySomeField($value): ?Address
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
