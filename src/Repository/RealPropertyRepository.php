<?php

namespace App\Repository;

use App\DTO\RealPropertySearchCriteria;
use App\Entity\RealProperty;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RealProperty>
 *
 * @method RealProperty|null find($id, $lockMode = null, $lockVersion = null)
 * @method RealProperty|null findOneBy(array $criteria, array $orderBy = null)
 * @method RealProperty[]    findAll()
 * @method RealProperty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RealPropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RealProperty::class);
    }

    public function save(RealProperty $entity, bool $flush = false): void
    {
        // sauvegarde des dates automatiquement, pas besoin
        // de rajouter de code dans le controller
        $entity->setUpdatedAt(new DateTime());

        if (!$entity->getCreatedAt()) {
            $entity->setCreatedAt(new DateTime());
        }

        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RealProperty $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Récupére tout les biens immobilier par leurs critéres de recherche
     */
    public function findAllBySearchCriteria(RealPropertySearchCriteria $criteria): array
    {
        // Création du query builder
        $qb = $this->createQueryBuilder('realProperty');

        // Mise en place de la pagination
        $qb
            ->setFirstResult(($criteria->page - 1) * $criteria->limit)
            ->setMaxResults($criteria->limit);

        // Mise en pace du trie
        $qb->orderBy("realProperty.{$criteria->orderBy}", $criteria->direction);

        // Recherche par type si présent
        if ($criteria->type) {
            $qb->andWhere('realProperty.type = :type')->setParameter('type', $criteria->type);
        }

        // Recherche par surface mininum
        if ($criteria->minTotalArea) {
            $qb
                ->andWhere('realProperty.totalArea >= :minArea')
                ->setParameter('minArea', $criteria->minTotalArea);
        }

        // Recherche par surface maximum
        if ($criteria->maxTotalArea) {
            $qb
                ->andWhere('realProperty.totalArea <= :maxArea')
                ->setParameter('maxArea', $criteria->maxTotalArea);
        }

        // Recherche par prix minimum
        if ($criteria->minPrice) {
            $qb
                ->andWhere('realProperty.price >= :minPrice')
                ->setParameter('minPrice', $criteria->minPrice);
        }

        // Recherche par prix maximum
        if ($criteria->maxPrice) {
            $qb
                ->andWhere('realProperty.price <= :maxPrice')
                ->setParameter('maxPrice', $criteria->maxPrice);
        }

        // Recherche par piéces minimum
        if ($criteria->minRooms) {
            $qb
                ->andWhere('realProperty.numberOfRooms >= :minRooms')
                ->setParameter('minRooms', $criteria->minRooms);
        }

        // Recherche par piéces maximum
        if ($criteria->maxRooms) {
            $qb
                ->andWhere('realProperty.numberOfRooms <= :maxRooms')
                ->setParameter('maxRooms', $criteria->maxRooms);
        }

        // Recherche par adresse
        if ($criteria->address) {
            $qb
                ->leftJoin('realProperty.address', 'address')
                ->andWhere("CONCAT(address.street, ', ', address.postCode, ', ', address.city) LIKE :address")
                ->setParameter('address', "%{$criteria->address}%");
        }

        // Retourne les résultats
        return $qb->getQuery()->getResult();
    }
}
