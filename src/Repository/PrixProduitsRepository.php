<?php

namespace App\Repository;

use App\Entity\PrixProduits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PrixProduits>
 *
 * @method PrixProduits|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrixProduits|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrixProduits[]    findAll()
 * @method PrixProduits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrixProduitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrixProduits::class);
    }

//    /**
//     * @return PrixProduits[] Returns an array of PrixProduits objects
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

//    public function findOneBySomeField($value): ?PrixProduits
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
