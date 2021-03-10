<?php

namespace App\Repository;

use App\Entity\MeterReading;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MeterReading|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeterReading|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeterReading[]    findAll()
 * @method MeterReading[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeterReadingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeterReading::class);
    }

     /**
      * @return MeterReading[] Returns an array of MeterReading objects
      */

    public function findAllNonDeletedMeterReading()
    {
        return $this->createQueryBuilder('mr')
            ->innerJoin('mr.meter', 'm')
            ->addSelect('m')
            ->andWhere('mr.isDeleted = :val')
            ->setParameter('val',false)
            ->orderBy('m.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?MeterReading
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
