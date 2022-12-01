<?php

namespace App\Repository;

use App\DTO\UserSearchCriteria;
use App\Entity\User;
use App\Repository\Helper\BuildPagination;
use App\Repository\Helper\BuildSort;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    use BuildPagination;
    use BuildSort;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $entity, bool $flush = false): void
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

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Récupére tout les utilisateurs correspondant aux critéres de
     * recherche
     */
    public function findAllBySearchCriteria(UserSearchCriteria $criteria): array
    {
        // Création du query builder
        $qb = $this->createQueryBuilder('user');

        // Pagination & Trie
        $this->buildSort($qb, 'user', $criteria)->buildPagination($qb, $criteria);

        // La recheche par email
        if ($criteria->email) {
            $qb->andWhere('user.email = :email')->setParameter('email', $criteria->email);
        }

        // on retourne les résultats
        return $qb->getQuery()->getResult();
    }
}
