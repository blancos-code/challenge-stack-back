<?php

namespace App\Repository;

use App\Entity\CommentaireProducteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommentaireProducteur>
 *
 * @method CommentaireProducteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireProducteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireProducteur[]    findAll()
 * @method CommentaireProducteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireProducteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentaireProducteur::class);
    }

//    /**
//     * @return CommentaireProducteur[] Returns an array of CommentaireProducteur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CommentaireProducteur
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
