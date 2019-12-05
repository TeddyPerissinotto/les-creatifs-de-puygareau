<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{

    public function imageRelation()
{
    return $this->createQueryBuilder('a')
        ->select('a as articles', 'i.title as images' )
        ->leftJoin('a.images', 'i')
        ->getQuery()
        ->execute();
}


    public function findByTitle($word)
    {
        return $this->createQueryBuilder('a')
            //Je cible un 'word' dans  le champs "title"
            ->where('a.title LIKE :word' )
            // Jointure avec la table Images
            ->leftJoin('a.images', 'img')
            // Rajoute les images au résultat de requête
            ->addSelect('img')
            //setParameter est une méthode qui sécurise ma variable $word passée
            ->setParameter('word', '%'.$word.'%')
            ->getQuery()
            ->getArrayResult();
    }
    //Requête SQL :
    //SELECT * FROM articles LEFT JOIN images ON articles.id = images.articles_id WHERE articles.title LIKE :word


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

    // /**
    //  * @return Articles[] Returns an array of Articles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Articles
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
