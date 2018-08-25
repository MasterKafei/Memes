<?php

namespace AppBundle\Service\Business;

use AppBundle\Entity\FavoriteVote;
use AppBundle\Entity\LikeVote;
use AppBundle\Entity\Post;
use AppBundle\Entity\Vote;
use AppBundle\Service\Util\AbstractContainerAware;

class VoteBusiness extends AbstractContainerAware
{
    public function isVoteValid(Vote $vote)
    {
        $similarVote = $this->container->get('doctrine')->getRepository(get_class($vote))->findSimilarVote($vote);

        return count($similarVote) === 0;
    }

    private function getUserVoteIdentificationCriteria()
    {
        $userBusiness = $this->container->get('app.business.user');
        $user = $userBusiness->loadUser();

        if ($userBusiness->isUserRegister($user)) {
            $options = array(
                'user' => $user,
            );
        } else {
            $options = array(
                'userIp' => $this->container->get('app.business.request')->getMasterRequest()->getClientIp(),
            );
        }

        return $options;
    }

    public function getFavoriteUserVotes()
    {

        $options = $this->getUserVoteIdentificationCriteria();

        $votes = $this->container->get('doctrine')->getRepository(FavoriteVote::class)->findBy($options);

        return $votes;
    }

    public function getLikeUserVotes()
    {
        $options = $this->getUserVoteIdentificationCriteria();

        $votes = $this->container->get('doctrine')->getRepository(LikeVote::class)->findBy($options);

        return $votes;
    }

    public function hasUserFavoriteVotePost(Post $post)
    {
        return $this->getUserFavoriteVotePost($post) !== null;
    }

    public function hasUserLikeVotePost(Post $post)
    {
        return $this->getUserLikeVotePost($post) !== null;
    }

    public function getUserFavoriteVotePost(Post $post)
    {
        $options = $this->getUserVoteIdentificationCriteria();
        $options['post'] = $post;

        $vote = $this->container->get('doctrine')->getRepository(FavoriteVote::class)->findOneBy(
            $options
        );

        return $vote;
    }

    public function getUserLikeVotePost(Post $post)
    {
        $options = $this->getUserVoteIdentificationCriteria();
        $options['post'] = $post;

        $vote = $this->container->get('doctrine')->getRepository(LikeVote::class)->findOneBy(
            $options
        );

        return $vote;
    }
}
