<?php

namespace App\Repository;

use App\Entity\CommentaireMarche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommentaireMarche>
 *
 * @method CommentaireMarche|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireMarche|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireMarche[]    findAll()
 * @method CommentaireMarche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireMarcheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentaireMarche::class);
    }

//    /**
//     * @return CommentaireMarche[] Returns an array of CommentaireMarche objects
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

//    public function findOneBySomeField($value): ?CommentaireMarche
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
