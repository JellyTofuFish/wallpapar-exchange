<?php

namespace App\Repository;

use App\Entity\PictureCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PictureCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method PictureCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method PictureCategories[]    findAll()
 * @method PictureCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PictureCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PictureCategories::class);
    }

    // /**
    //  * @return PictureCategories[] Returns an array of PictureCategories objects
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
    public function findOneBySomeField($value): ?PictureCategories
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
