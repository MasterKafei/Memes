<?php

namespace AppBundle\Service\Validator\Achievement;

use AppBundle\Entity\Validator;
use AppBundle\Service\Business\AchievementBusiness;
use AppBundle\Service\Util\AbstractContainerAware;

class FavoriteVoteNumberValidator extends AbstractContainerAware implements AchievementValidator
{
    public function isValid($parameters)
    {
        $number = $parameters['number'];

        $votes = $this->container->get('app.business.vote')->getFavoriteUserVotes();
        return count($votes) >= $number;
    }

    public function getType()
    {
        return Validator::FAVORITE_VOTE_TYPE;
    }
}
