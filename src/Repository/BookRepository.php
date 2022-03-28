<?php

namespace App\Repository;

use App\DTO\Admin\AdminBookSearch;
use App\DTO\SearchBook;
use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Book $entity, bool $flush = true): void
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
    public function remove(Book $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Book[] Returns an array of Book objects
     */
    public function findExample()
    {
        // Le language utilisé par se query builder: DQL (Doctrine Query Language)
        // Création d'un constructeur de requête nommé "book"
        $qb = $this->createQueryBuilder('book');

        $qb
            // Limiter les résultat à 10
            ->setMaxResults(10)
            // Ordonner mes résultat: par prix croissant
            ->orderBy('book.price', 'ASC');

        // Définir l'offset de mes résultat
        $qb->setFirstResult(10);

        // Ajouter une condition graçe à where
        $qb->andWhere('book.price >= 5');

        // Utiliser les paramètres:
        $search = "Harr";
        $qb->andWhere('book.title LIKE :title');
        $qb->setParameter('title', '%' . $search . '%');

        // Faire des jointures
        $qb->leftJoin('book.author', 'author');
        $qb->andWhere('author.name = "J.K Rowling"');

        // Tout les livres qui posséde la catégorie avec l'identifiant 1
        $qb->leftJoin('book.categories', 'category');
        $qb->andWhere('category.id = 1');

        // On retourne tout les livres de la requête
        return $qb
            // Génére la requête SQL
            ->getQuery()
            // Récupére les résultats de la requête
            ->getResult(); // array de App\Entity\Book
    }

    public function findFiveLast(): array
    {
        $queryBuilder = $this->createQueryBuilder('book');
        $queryBuilder->setMaxResults(5);
        $queryBuilder->orderBy('book.id', 'DESC');

        return $queryBuilder
            // Générer la requête
            ->getQuery()
            // Éxécute la requête et retourne ses résultats
            ->getResult();
    }

    public function findFiveLastCheaper(): array
    {
        $queryBuilder = $this->createQueryBuilder('book');
        $queryBuilder->setMaxResults(5);
        $queryBuilder->orderBy('book.price', 'ASC');

        return $queryBuilder
            // Générer la requête
            ->getQuery()
            // Éxécute la requête et retourne ses résultats
            ->getResult();
    }

    public function findLastTenForAuthor(int $id): array
    {
        $queryBuilder = $this->createQueryBuilder('book');
        $queryBuilder->setMaxResults(10);
        $queryBuilder->leftJoin('book.author', 'author');
        $queryBuilder->andWhere('author.id = :id');
        $queryBuilder->setParameter('id', $id);

        return $queryBuilder
            // Générer la requête
            ->getQuery()
            // Éxécute la requête et retourne ses résultats
            ->getResult();
    }

    public function findLastTenMatchingTitle(string $title): array
    {
        $queryBuilder = $this->createQueryBuilder('book');
        $queryBuilder->setMaxResults(10);
        $queryBuilder->andWhere('book.title LIKE :title');
        $queryBuilder->setParameter('title', "%$title%");

        return $queryBuilder
            // Générer la requête
            ->getQuery()
            // Éxécute la requête et retourne ses résultats
            ->getResult();
    }

    public function findBySearch(?string $title, int $limit = 5, int $page = 1): array
    {
        if ($limit === 0) {
            $limit = 5;
        }

        if ($page === 0) {
            $page = 1;
        }

        $queryBuilder = $this->createQueryBuilder('book');
        $queryBuilder->setMaxResults($limit);
        $queryBuilder->setFirstResult($limit * ($page - 1));

        if ($title) {
            $queryBuilder->andWhere('book.title LIKE :title');
            $queryBuilder->setParameter('title', "%$title%");
        }

        return $queryBuilder
            // Générer la requête
            ->getQuery()
            // Éxécute la requête et retourne ses résultats
            ->getResult();
    }

    public function findAllFilteredBy(SearchBook $searchBook): array
    {
        $queryBuilder = $this->createQueryBuilder('book');

        $queryBuilder->setMaxResults($searchBook->limit);
        $queryBuilder->setFirstResult($searchBook->limit * ($searchBook->page - 1));
        $queryBuilder->orderBy('book.' . $searchBook->sortBy, $searchBook->direction);

        if ($searchBook->title) {
            $queryBuilder->andWhere('book.title LIKE :title');
            $queryBuilder->setParameter('title', "%{$searchBook->title}%");
        }

        if ($searchBook->authorName) {
            $queryBuilder->leftJoin('book.author', 'author');
            $queryBuilder->andWhere('author.name LIKE :authorName');
            $queryBuilder->setParameter('authorName', "%{$searchBook->authorName}%");
        }

        if ($searchBook->categories && !$searchBook->categories->isEmpty()) {
            $queryBuilder->leftJoin('book.categories', 'category');
            $queryBuilder->andWhere($queryBuilder->expr()->in('category.id', $searchBook->categories->map(function ($category) {
                return $category->getId();
            })));
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    public function findByAdminSearch(AdminBookSearch $search): array
    {
        $queryBuilder = $this->createQueryBuilder('book');
        $queryBuilder->setMaxResults($search->limit);
        $queryBuilder->setFirstResult($search->limit * ($search->page - 1));
        $queryBuilder->orderBy("book.{$search->sortBy}", $search->direction);

        if ($search->title !== null) {
            $queryBuilder->andWhere('book.title LIKE :title');
            $queryBuilder->setParameter('title', "%{$search->title}%");
        }

        if ($search->authorName !== null) {
            $queryBuilder->leftJoin('book.author', 'author');
            $queryBuilder->andWhere('author.name LIKE :authorName');
            $queryBuilder->setParameter('authorName', "%{$search->authorName}%");
        }

        if ($search->minPrice !== null) {
            $queryBuilder->andWhere('book.price >= :minPrice');
            $queryBuilder->setParameter('minPrice', $search->minPrice);
        }

        if ($search->maxPrice !== null) {
            $queryBuilder->andWhere('book.price <= :maxPrice');
            $queryBuilder->setParameter('maxPrice', $search->maxPrice);
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }
}
