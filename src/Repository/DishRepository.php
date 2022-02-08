<?php

namespace App\Repository;

use App\Entity\Dish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dish|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dish|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dish[]    findAll()
 * @method Dish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dish::class);
    }

    // 1. Récupérer tout les plats ordonnées par prix croissant
    // 2. Récupérer tout les plats dont le nom commence par Pizza
    // 3. Récupérer uniquement 5 plats ordonée par nom croissant
    // 4. Récupérer les 10 plats à partir de la page n°2, ordonée par prix decroissant
    // 5. Récupérer les 15 plats avec l'ingrédient "Tomate"


    public function findAllOrderedByPrice()
    {
        $name = "Pizza est";

        return $this->createQueryBuilder('dish') // On créé le query builder
            ->andWhere("dish.name = :pizzaName") // Ajoute un where
            ->setParameter('pizzaName', $name) // Définie un paramètre
            ->leftJoin('dish.ingredients', 'ingredient') // On join les ingrédients
            ->andWhere('ingredient.name = :ingredientName') // On ajoute une condition sur les ingrédient
            ->setParameter('ingredientName', 'tomate') // On remplace le paramètre
            ->orderBy('dish.price', 'DESC') // On ajoute un order by
            ->setMaxResults(10) // Limit les résultat
            ->setFirstResult(20) // Spécifie un offset de départ
            ->getQuery() // On obtient la requête SQL
            ->getResult(); // On éxécute la requête et on retourne les résultats
    }

    // /**
    //  * @return Dish[] Returns an array of Dish objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dish
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
