<?php

namespace App\Repository;

use App\Entity\Producteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Producteur>
 *
 * @method Producteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Producteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Producteur[]    findAll()
 * @method Producteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProducteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producteur::class);
    }

//    /**
//     * @return Producteur[] Returns an array of Producteur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Producteur
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
