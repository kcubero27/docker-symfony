<?php

namespace App\Repository;

use App\Entity\TinyPizza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TinyPizza|null find($id, $lockMode = null, $lockVersion = null)
 * @method TinyPizza|null findOneBy(array $criteria, array $orderBy = null)
 * @method TinyPizza[]    findAll()
 * @method TinyPizza[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TinyPizzaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TinyPizza::class);
    }

    /**
     * @return TinyPizza[] Returns an array of TinyPizza objects
     */
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?TinyPizza
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
