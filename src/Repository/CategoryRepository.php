<?php

namespace App\Repository;

use App\DTO\Admin\AdminCategorySearch;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Category $entity, bool $flush = true): void
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
    public function remove(Category $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findByAdminSearch(AdminCategorySearch $search): array
    {
        $queryBuilder = $this->createQueryBuilder('category');
        $queryBuilder->setMaxResults($search->limit);
        $queryBuilder->setFirstResult($search->limit * ($search->page - 1));
        $queryBuilder->orderBy("category.{$search->sortBy}", $search->direction);

        if ($search->name !== null) {
            $queryBuilder->andWhere('category.name LIKE :name');
            $queryBuilder->setParameter('name', "%{$search->name}%");
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }
}
