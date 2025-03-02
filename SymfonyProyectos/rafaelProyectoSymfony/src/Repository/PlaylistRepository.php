<?php

namespace App\Repository;

use App\Entity\Playlist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Playlist>
 */
class PlaylistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Playlist::class);
    }
    public function getPlaylist() : array {
        return $this->findAll();;
    }
    public function getCoincidenciasPlaylist($subcadena) : array {
        return $this->createQueryBuilder('p')
            ->where('p.nombre LIKE :subcadena')
            ->setParameter('subcadena', '%' . $subcadena . '%')
            ->getQuery()
            ->getResult();
    }
    
   public function getPlaylistMasEscuchadas($num=3): array
   {
       return $this->createQueryBuilder('p')
           ->orderBy('p.reproducciones', 'DESC')
           ->setMaxResults($num)
           ->getQuery()
           ->getResult()
       ;
   }

    //    /**
    //     * @return Playlist[] Returns an array of Playlist objects
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

    //    public function findOneBySomeField($value): ?Playlist
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
