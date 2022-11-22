<?php

namespace App\Repository;

use App\Entity\Ad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ad>
 *
 * @method Ad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ad[]    findAll()
 * @method Ad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ad::class);
    }

    public function save(Ad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBySearchText(string $search): array
    {
        // Afin de faire des reqûetes à la base de données il faut
        // tout d'abord créer un query builder :
        //
        // Pour créer ce query, utiliser $this->createQueryBuilder et
        // spécifier un alias de recherche.
        $qb = $this->createQueryBuilder('ad');

        // Afin de faire une condition sur une relation de l'entité Ad (Les livres),
        // nous devons réaliser une jointure. Pour cela nous pouvons utiliser 
        // $qb->innerJoin
        // $qb->join
        // $qb->leftJoin
        $qb->leftJoin('ad.book', 'book');

        // Il est possible de rajouter des conditions SQL (WHERE) en
        // utilisant  $qb->andWhere
        //
        // TRES IMPORTANT : Il est formellement interdit et bannie de mettre
        // dans variables diréctement dans un andWhere !!!!!
        $qb->andWhere("ad.title LIKE :search OR book.title LIKE :search");

        // Il est possible de spécifier la valeur d'un paramètre DQL
        // en utilisant $qb->setParameter
        //
        // TRES IMPORTANT : Grâce à ces paramètres doctrine est en capacité
        // de vous protéger de l'injection SQL!!!
        $qb->setParameter('search', "%$search%");

        // Il est possible de limiter le nombre de résultats :
        $qb->setMaxResults(2);

        // Il est aussi possible de trier les résultats :
        $qb->orderBy('ad.updatedAt', 'DESC');

        // Il est possible de spécifier un « offset » :
        $qb->setFirstResult(4);

        // Afin de lancer la requête à la base de données, nous devons le faire
        // 2 étape :
        // 1. Récupére la requête avec : $sql = $qb->getQuery();
        // 2. Lancer la requête : $sql->getResult();
        $data = $qb->getQuery()->getResult();

        // Nous pouvons enchainer la totalité des fonctions :
        return $this->createQueryBuilder('ad')
            ->leftJoin('ad.book', 'book')
            ->andWhere('ad.title LIKE :search OR book.title LIKE :search')
            ->setParameter('search', "%$search%")
            ->setMaxResults(10)
            ->orderBy('ad.updatedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Ad[] Returns an array of Ad objects
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

    //    public function findOneBySomeField($value): ?Ad
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
