<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
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

    public function save(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllActiveCategories()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.isActive = 1')
            ->orderBy('c.sortIndex', 'ASC')
            ->getQuery()
            ->getResult()
       ;
    }

    public function findFilteredProducts(?string $slug, ?array $filter = null)
    {
        $qb = $this->createQueryBuilder('c')
            ->leftJoin('c.products', 'p')
            ->addSelect('p')
            ->leftJoin('p.prices', 'pp')
            ->addSelect('pp')
            ->andWhere('p.isActive = 1')
            ->andWhere('pp.value IS NOT NULL')
            ->andWhere('pp.value > 0')
        ;

        if (isset($slug) && !empty($slug)) {
            $qb->andWhere('c.slug = :slug')
                ->setParameter('slug', $slug)
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

            $qb->innerJoin('p.seller', 's')
                ->addSelect('s')
                ->andWhere('s.name = :seller')
                ->setParameter('seller', $seller)
            ;
        }

        return  $qb->getQuery()
            ->getOneOrNullResult()
        ;


        return $this->createQueryBuilder('c')

            ->leftJoin('c.products', 'p')
            ->addSelect('p')
            ->leftJoin('p.prices', 'pp')
            ->addSelect('pp')
            ->andWhere('p.isActive = 1')
            ->andWhere('c.slug = :slug')
            ->andWhere('pp.value IS NOT NULL')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

//    /**
//     * @return Category[] Returns an array of Category objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Category
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
