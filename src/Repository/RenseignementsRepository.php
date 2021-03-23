<?php

namespace App\Repository;

use App\Entity\Renseignements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Renseignements|null find($id, $lockMode = null, $lockVersion = null)
 * @method Renseignements|null findOneBy(array $criteria, array $orderBy = null)
 * @method Renseignements[]    findAll()
 * @method Renseignements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RenseignementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Renseignements::class);
    }

    // /**
    //  * @return Renseignements[] Returns an array of Renseignements objects
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
    public function findOneBySomeField($value): ?Renseignements
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
