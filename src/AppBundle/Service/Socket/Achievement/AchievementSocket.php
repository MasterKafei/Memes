<?php

namespace AppBundle\Service\Socket\Achievement;

use AppBundle\Entity\AchievementModel;
use AppBundle\Service\Socket\AbstractSocket;

class AchievementSocket extends AbstractSocket
{
    public function sendAchievementNotification(AchievementModel $model)
    {
        $this->sendDataToCurrentUser(
            $this->container->get('app.business.achievement')->getRenderedAchievement($model),
            'app_achievement_notify',
            array(
                'socket_session_id' => $this->container->get('app.business.user')->getSocketSessionId(),
            ));
    }
}
