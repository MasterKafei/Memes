<?php

namespace AppBundle\Service\Listener\Achievement;


use AppBundle\Entity\FavoriteVote;
use AppBundle\Entity\Validator;
use AppBundle\Service\Business\AchievementBusiness;
use AppBundle\Service\Util\AbstractContainerAware;
use Doctrine\ORM\Event\LifecycleEventArgs;

class FavoriteVoteListener extends AbstractContainerAware
{
    public function postPersist(FavoriteVote $vote, LifecycleEventArgs $args)
    {
        $this->container->get('app.business.achievement')->checkAchievementByType(Validator::FAVORITE_VOTE_TYPE);
    }
}
