<?php

namespace App\Repository;

use App\Entity\Exemplaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Exemplaires>
 *
 * @method Exemplaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exemplaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exemplaires[]    findAll()
 * @method Exemplaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExemplairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exemplaires::class);
    }

//    /**
//     * @return Exemplaires[] Returns an array of Exemplaires objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Exemplaires
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
