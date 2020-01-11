<?php

namespace App\Repository;

use App\Entity\Peripherique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Peripherique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Peripherique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Peripherique[]    findAll()
 * @method Peripherique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeripheriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Peripherique::class);
    }

    public function GetByVitality()
    {
        // - Récupérer le query builder (car c'est le query builder qui permet de faire la requete SQL)
        $queryBuilder = $this->createQueryBuilder('v');

        // - Construire la requete façon SQL, mais en PHP
        // - Traduire la requête en véritable requête SQL
        $query = $queryBuilder->select('v')
            ->where('v.equipe = :equipe')
            ->setParameter('equipe', 'Vitality')
            ->getQuery();
        // - Executer la requête SQL en base de données pour récupérer les bons Périphériques
        $vitality = $query->getArrayResult();

        return $vitality;
    }
    public function GetBySolary()
    {
        // - Récupérer le query builder (car c'est le query builder qui permet de faire la requete SQL)
        $queryBuilder = $this->createQueryBuilder('s');

        // - Construire la requete façon SQL, mais en PHP
        // - Traduire la requête en véritable requête SQL
        $query = $queryBuilder->select('e')
            ->where('s.equipe = :equipe')
            ->setParameter('equipe', 'Solary')
            ->getQuery();
        // - Executer la requête SQL en base de données pour récupérer les bons Périphériques
        $solary = $query->getArrayResult();

        return $solary;
    }
    public function GetByLestream()
    {
        // - Récupérer le query builder (car c'est le query builder qui permet de faire la requete SQL)
        $queryBuilder = $this->createQueryBuilder('l');

        // - Construire la requete façon SQL, mais en PHP
        // - Traduire la requête en véritable requête SQL
        $query = $queryBuilder->select('l')
            ->where('l.equipe = :equipe')
            ->setParameter('equipe', 'Lestream')
            ->getQuery();
        // - Executer la requête SQL en base de données pour récupérer les bons Périphériques
        $lestream = $query->getArrayResult();

        return $lestream;
    }

    // /**
    //  * @return Peripherique[] Returns an array of Peripherique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Peripherique
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
