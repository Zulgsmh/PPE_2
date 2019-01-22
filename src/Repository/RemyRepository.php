<?php

namespace App\Repository;

use App\Entity\Remy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Remy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Remy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Remy[]    findAll()
 * @method Remy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Remy::class);
    }

    // /**
    //  * @return Remy[] Returns an array of Remy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Remy
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
