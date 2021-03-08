<?php

namespace App\Repository;

use App\Entity\Heater;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Heater|null find($id, $lockMode = null, $lockVersion = null)
 * @method Heater|null findOneBy(array $criteria, array $orderBy = null)
 * @method Heater[]    findAll()
 * @method Heater[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeaterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Heater::class);
    }

    /**
     * @return Heater[] Returns an array of Heater objects
     */

    public function findAllNonDeletedHeater()
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.isDeleted = :val')
            ->setParameter('val', false)
            ->orderBy('h.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Heater
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
