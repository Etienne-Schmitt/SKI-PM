<?php

namespace App\Repository;

use App\Entity\Race;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Race|null find($id, $lockMode = null, $lockVersion = null)
 * @method Race|null findOneBy(array $criteria, array $orderBy = null)
 * @method Race[]    findAll()
 * @method Race[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Race::class);
    }

    /**
     * @return string[] Returns an array of all categories
     */
    public function getAllCategories(): ?array
    {
        $categories = $this->createQueryBuilder('race')
            ->select("DISTINCT race.category")
            ->getQuery()
            ->getArrayResult();

        for ($i = 0; $i < count($categories); $i++) {
            $categories[$i] = $categories[$i]["category"];
        }

        return $categories;
    }

    public function getAllRacesAs(string $category) : ?array
    {
        return $this->createQueryBuilder('race')
            ->select('race.name, race.date')
            ->where('race.category = :category')
            ->setParameter('category', $category)
            ->orderBy('race.date', 'DESC')
            ->getQuery()
            ->getArrayResult();
    }


    // /**
    //  * @return Race[] Returns an array of Race objects
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
    public function findOneBySomeField($value): ?Race
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
