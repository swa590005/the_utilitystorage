<?php

namespace App\Repository;

use App\Entity\Room;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Room|null find($id, $lockMode = null, $lockVersion = null)
 * @method Room|null findOneBy(array $criteria, array $orderBy = null)
 * @method Room[]    findAll()
 * @method Room[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Room::class);
    }

     /**
      * @return Room[] Returns an array of Room objects
      */

    public function findAllNonDeletedRoom()
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.isDeleted = :val')
            ->setParameter('val', false)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Room
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
