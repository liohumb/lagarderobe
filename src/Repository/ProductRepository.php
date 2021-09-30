<?php

namespace App\Repository;

use App\Class\Filter;
use App\Class\FilterBaby;
use App\Class\FilterMen;
use App\Class\FilterWomen;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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
     * Requête qui me permet de récupérer les produits en fonction du filtrage de l'utilisateur
     * @param Filter $filter
     * @return Product[]
     */
    public function findWithFilter(Filter $filter): array
    {
        $query = $this->createQueryBuilder('p')
                      ->select('c', 'g', 'p')
                      ->join('p.category','c')
                      ->join('p.gender', 'g');

        if (!empty($filter->categories) && !empty($filter->gender)) {
            $query = $query->andWhere('c.id IN (:categories)', 'g.id IN (:genders)')
                           ->setParameter('categories', $filter->categories)
                           ->setParameter('genders', $filter->gender);
        }

        return $query->getQuery()->getResult();
    }

    /**
     * Requête qui me permet de récupérer les produit du genre 'femme' en fonction du filtrage de l'utilisateur
     * @param FilterWomen $filterWomen
     * @return Product[]
     */
    public function findWithFilterWomen(FilterWomen $filterWomen): array
    {
        $query = $this->createQueryBuilder('p')
                      ->select('w', 'p')
                      ->join('p.category', 'w');

        if (!empty($filterWomen->categories)) {
            $query = $query->andWhere('w.id IN (:categories)')
                           ->setParameter('categories', $filterWomen->categories);
        }

        return $query->getQuery()->getResult();
    }

    public function findWithFilterMen(FilterMen $filterMen) {
        $query = $this->createQueryBuilder('p')
                      ->select('m', 'p')
                      ->join('p.category', 'm');

        if (!empty($filterMen->categories)) {
            $query = $query->andWhere('m.id IN (:categories)')
                           ->setParameter('categories', $filterMen->categories);
        }

        return $query->getQuery()->getResult();
    }

    public function findWithFilterBaby(FilterBaby $filterBaby) {
        $query = $this->createQueryBuilder('p')
                      ->select('b', 'p')
                      ->join('p.category', 'b');

        if (!empty($filterBaby->categories)) {
            $query = $query->andWhere('b.id IN (:categories)')
                           ->setParameter('categories', $filterBaby->categories);
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
