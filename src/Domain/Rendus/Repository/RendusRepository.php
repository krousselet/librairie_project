<?php

<<<<<<<< HEAD:src/Domain/Rendu/Repository/RendusRepository.php
namespace App\Domain\Rendu\Repository;

use App\Domain\Rendu\Rendus;
========
namespace App\Domain\Rendus\Repository;

use App\Domain\Rendus\Rendus;
>>>>>>>> 69ab43474f6ef6d7d784cfc3087503fc46623873:src/Domain/Rendus/Repository/RendusRepository.php
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rendus>
 *
 * @method Rendus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rendus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rendus[]    findAll()
 * @method Rendus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RendusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rendus::class);
    }

//    /**
//     * @return Rendus[] Returns an array of Rendus objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Rendus
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
