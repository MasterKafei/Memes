<?php

namespace AppBundle\Service\Validator\Achievement;

use AppBundle\Service\Business\AchievementBusiness;
use AppBundle\Service\Util\AbstractContainerAware;

class LikeVoteNumberValidator extends AbstractContainerAware implements AchievementValidator
{
    public function isValid($parameters)
    {
        $number = $parameters['number'];

        $votes = $this->container->get('app.business.vote')->getLikeUserVotes();
        return count($votes) >= $number;
    }

    public function getType()
    {
        return AchievementBusiness::LIKE_VOTE_TYPE;
    }
}
