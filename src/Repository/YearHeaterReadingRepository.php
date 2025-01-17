<?php

namespace App\Repository;

use App\Entity\YearHeaterReading;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method YearHeaterReading|null find($id, $lockMode = null, $lockVersion = null)
 * @method YearHeaterReading|null findOneBy(array $criteria, array $orderBy = null)
 * @method YearHeaterReading[]    findAll()
 * @method YearHeaterReading[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YearHeaterReadingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, YearHeaterReading::class);
    }

    /**
     * @return YearHeaterReading[] Returns an array of YearHeaterReading objects
     */

    public function findAllNonDeletedYearHeater()
    {
        return $this->createQueryBuilder('y')
            ->innerJoin('y.heater', 'h')
            ->addSelect('h')
            ->andWhere('y.isDeleted = :val')
            ->setParameter('val', false)
            ->orderBy('y.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?YearHeaterReading
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
