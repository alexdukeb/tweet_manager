<?php
// src/Repository/TweetRepository.php
namespace App\Repository;

use App\Entity\Tweet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;


class TweetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tweet::class);
    }

    public function findAllByParams($page, $count, $author, $hashtag): array
    {
        $qb = $this->createQueryBuilder('t');
        if ($author) {
            $qb->where('t.author = :author')->setParameter('author', $author);
        }
        if ($hashtag) {
            $qb->innerJoin('App\Entity\Hashtag', 'h', 'WITH', 't.id = h.tweet')
            ->andWhere('h.content = :hashtag')->setParameter('hashtag', $hashtag);
        }

        $qb->setMaxResults($count)->setFirstResult(($page-1) * $count);
        $query = $qb->getQuery();

        return $query->execute();
    }
}