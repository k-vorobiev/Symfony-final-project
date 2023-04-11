<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Seller;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
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

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findTopProducts()
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.sortIndex IS NOT NULL')
            ->innerJoin('p.prices', 'pp')
            ->addSelect('pp')
            ->andWhere('pp.value IS NOT NULL')
            ->andWhere('pp.value > 0')
            ->addOrderBy('p.sortIndex', 'ASC')
            ->setMaxResults(9)
        ;

        return $qb->getQuery()
            ->getResult()
        ;
    }

    public function findFilteredProducts(?array $filter, $category = null)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.prices', 'pp')
            ->innerJoin('p.seller', 's')
            ->addSelect('pp')
            ->addSelect('s')
            ->andWhere('pp.value IS NOT NULL')
            ->andWhere('pp.value > 0')
        ;

        if (isset($category) && !empty($category)) {
            $qb->andWhere('p.category = :category_id')
                ->setParameter('category_id', $category)
            ;
        }

        if (isset($filter['title']) && !empty($filter['title'])) {
            $title = $filter['title'];

            $qb->andWhere('p.title LIKE :title')
                ->setParameter('title', "%$title%")
            ;
        }

        if (isset($filter['seller']) && !empty($filter['seller'])) {
            $seller = $filter['seller'];

            $qb->andWhere('s.id = :seller')
                ->setParameter('seller', $seller)
            ;
        }

        if ((isset($filter['price_from']) && !empty($filter['price_from'])) && isset($filter['price_to']) && !empty($filter['price_to'])) {
            $qb->andWhere('pp.value BETWEEN :price_from AND :price_to')
                ->setParameter('price_from', $filter['price_from'])
                ->setParameter('price_to', $filter['price_to'])
            ;
        }

        if (!empty($filter['popular_sort'])) {
            $qb->addOrderBy('RAND()');
        }

        if (!empty($filter['price_sort'])) {
            $priceSort = $filter['price_sort'];

            if ($priceSort == 'increase') {
                $qb->addOrderBy('pp.value', 'ASC');
            } else {
                $qb->addOrderBy('pp.value', 'DESC');
            }
        }

        return $qb;
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
