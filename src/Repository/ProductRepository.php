<?php

namespace App\Repository;

use App\Class\FilterCategory;
use App\Class\FilterGender;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }


    /**
     * Requête qui me permet de récupérer les produits en fonction de la recherche de l'utilisateur
     * @return Product[]
     */
    public function findWithFilterCategory (FilterCategory $filterCategory): array
    {
        $query = $this->createQueryBuilder('p')
                      ->select('c', 'p')
                      ->join('p.category', 'c');

        if (!empty($filterCategory->categories)) {
            $query = $query->andWhere('c.id IN (:categories)')
                           ->setParameter('categories', $filterCategory->categories);
        }

        return $query->getQuery()->getResult();
    }


    /**
     * Requête qui me permet de récupérer les produits en fonction de la recherche de l'utilisateur
     * @return Product[]
     */
    public function findWithFilterGender (FilterGender $filterGender): array
    {
        $query = $this->createQueryBuilder('p')
                      ->select('g', 'p')
                      ->join('p.gender', 'g');

        if (!empty($filterGender->genders)) {
            $query = $query->andWhere('g.id IN (:genders)')
                           ->setParameter('genders', $filterGender->genders);
        }

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
