<?php

namespace App\Repository;

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
}
