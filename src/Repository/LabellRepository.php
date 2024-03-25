<?php

namespace App\Repository;

use App\Entity\Labell;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Labell>
 *
 * @method Labell|null find($id, $lockMode = null, $lockVersion = null)
 * @method Labell|null findOneBy(array $criteria, array $orderBy = null)
 * @method Labell[]    findAll()
 * @method Labell[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LabellRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Labell::class);
    }



//    /**
//     * @return Labell[] Returns an array of Labell objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Labell
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
