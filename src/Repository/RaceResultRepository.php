<?php

namespace App\Repository;

use App\Entity\Athlete;
use App\Entity\RaceResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RaceResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method RaceResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method RaceResult[]    findAll()
 * @method RaceResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RaceResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RaceResult::class);
    }

    // Les 3 meilleurs chrono de la dernière compétition d'une catégorie
    // SELECT * FROM `race_result` WHERE race_id = '$race' ORDER BY `race_result`.`run_average` ASC LIMIT 3
    public function lastPodiumResults(int $race) :?array
    {
        return $this->createQueryBuilder('result')
        ->leftJoin('result.athlete', 'athlete')
        ->setMaxResults(3)
        ->where('result.race = :race')
        ->select('result, athlete')
        ->setParameter("race", $race)
        ->orderBy('result.run_average', 'ASC')
        ->getQuery()
        ->getArrayResult();
    }

    public function getAllResultForRace(string $raceName): ?array
    {
        return $this->createQueryBuilder('result')
            ->leftJoin('result.athlete', 'athlete')
            ->leftJoin('result.race', 'race')
            ->select('result, athlete')
            ->where('race.name = :race_name')
            ->setParameter('race_name', $raceName)
            ->orderBy('result.run_average', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }


    // /**
    //  * @return RaceResult[] Returns an array of RaceResult objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RaceResult
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
