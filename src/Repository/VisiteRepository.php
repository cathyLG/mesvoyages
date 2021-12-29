<?php

namespace App\Repository;

use App\Entity\Visite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Visite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visite[]    findAll()
 * @method Visite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisiteRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Visite::class);
    }

    /**
     * fonction retroune les enregistrement trié en fonction de champ en paramètre
     * @param type $champ
     * @param type $ordre
     * @return Visite[]
     */
    public function findAllOrderBy($champ, $ordre): array {
        return $this->createQueryBuilder('v')
                        ->orderBy('v.' . $champ, $ordre)
                        ->getQuery()
                        ->getResult();
    }

    /**
     * filtrer les enregistrement par un champs
     * @param type $champ
     * @param type $valeur
     * @return Visite[]
     */
    public function findByEqualValeu($champ, $valeur): array {
        // si valeur vide, réafficher tous les enregistrements en fonction de chmpas ASC
        if ($valeur == '') {
            return $this->createQueryBuilder('v')
                            ->orderBy('v.' . $champ, 'ASC')
                            ->getQuery()
                            ->getResult();
        } else {
            return $this->createQueryBuilder('v')
                            ->andWhere('v.' . $champ . ' = :val')
                            ->setParameter('val', $valeur)
                            ->orderBy('v.datecreation', 'DESC')
                            ->getQuery()
                            ->getResult();
        }
    }

    // /**
    //  * @return Visite[] Returns an array of Visite objects
    //  */
    /*
      public function findByExampleField($value)
      {
      return $this->createQueryBuilder('v')
      ->andWhere('v.exampleField = :val')
      ->setParameter('val', $value)
      ->orderBy('v.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult()
      ;
      }
     */

    /*
      public function findOneBySomeField($value): ?Visite
      {
      return $this->createQueryBuilder('v')
      ->andWhere('v.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
}
