<?php

namespace App\Repository;

use App\Entity\HeaterReading;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HeaterReading|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeaterReading|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeaterReading[]    findAll()
 * @method HeaterReading[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeaterReadingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HeaterReading::class);
    }

    /**
     * @return HeaterReading[] Returns an array of YearHeaterReading objects
     */

    public function findAllNonDeletedHeaterReading()
    {
        return $this->createQueryBuilder('hr')
            ->innerJoin('hr.heater', 'h')
            ->addSelect('h')
            ->andWhere('hr.isDeleted = :val')
            ->setParameter('val', false)
            ->orderBy('hr.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return HeaterReading[] Returns an array of HeaterReading objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HeaterReading
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
