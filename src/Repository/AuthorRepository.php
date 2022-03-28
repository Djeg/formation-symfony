<?php

namespace App\Repository;

use App\DTO\Admin\AdminAuthorSearch;
use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
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

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Author $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Author $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findByAdminSearch(AdminAuthorSearch $search): array
    {
        $queryBuilder = $this->createQueryBuilder('author');
        $queryBuilder->setMaxResults($search->limit);
        $queryBuilder->setFirstResult($search->limit * ($search->page - 1));
        $queryBuilder->orderBy("author.{$search->sortBy}", $search->direction);

        if ($search->name !== null) {
            $queryBuilder->andWhere('author.name LIKE :name');
            $queryBuilder->setParameter('name', "%{$search->name}%");
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }
}
