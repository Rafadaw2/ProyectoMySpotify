<?php

namespace App\Repository;

use App\Entity\Cancion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cancion>
 */
class CancionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cancion::class);
    }

    public function getCancionesMasEscuchadas(int $num = 3) {
        return $this->createQueryBuilder('c')
            ->orderBy('c.reproducciones', 'DESC')
            ->setMaxResults($num)
            ->getQuery()
            ->getResult();
    }
    

    public function getCanciones() : array {
        $conn=$this->getEntityManager()->getConnection();
        $sql='SELECT * 
                FROM cancion ';
        $resulSet=$conn->executeQuery($sql);

        return $resulSet->fetchAllAssociative();
    }
    //    /**
    //     * @return Cancion[] Returns an array of Cancion objects
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

    //    public function findOneBySomeField($value): ?Cancion
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
