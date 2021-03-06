<?php

namespace AppBundle\Service\Listener\Achievement;

use AppBundle\Entity\LikeVote;
use AppBundle\Entity\Validator;
use AppBundle\Service\Business\AchievementBusiness;
use AppBundle\Service\Util\AbstractContainerAware;
use Doctrine\ORM\Event\LifecycleEventArgs;

class LikeVoteListener extends AbstractContainerAware
{
    public function postPersist(LikeVote $vote, LifecycleEventArgs $args)
    {
        $this->container->get('app.business.achievement')->checkAchievementByType(Validator::LIKE_VOTE_TYPE);
    }
}
