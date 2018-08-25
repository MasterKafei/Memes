<?php

namespace AppBundle\Repository;

use AppBundle\Entity\FavoriteVote;
use Doctrine\ORM\EntityRepository;

class FavoriteVoteRepository extends EntityRepository
{
    public function findSimilarVote(FavoriteVote $vote)
    {
        $queryBuilder = $this
            ->createQueryBuilder('vote')
            ->where('vote.post = :post');

        if($vote->getUser()) {
            $queryBuilder->andWhere('vote.user = :user')
                ->setParameter('user', $vote->getUser());
        } else {
            $queryBuilder->andWhere('vote.userIp = :userIp')
                ->setParameter('userIp', $vote->getUserIp());
        }

        return $queryBuilder
            ->setParameter('post', $vote->getPost())
            ->getQuery()->getResult();
    }
}
