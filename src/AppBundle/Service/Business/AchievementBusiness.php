<?php

namespace AppBundle\Service\Business;

use AppBundle\Entity\Achievement;
use AppBundle\Entity\AchievementModel;
use AppBundle\Service\Util\AbstractContainerAware;
use AppBundle\Service\Validator\Achievement\AchievementValidator;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Yaml\Yaml;

class AchievementBusiness extends AbstractContainerAware
{
    /**
     * Check if current user respect achievement by validator type
     * Mostly used by Achievement Listeners
     *
     * @param string $type
     */
    public function checkAchievementByType($type)
    {
        $modelsToCheck = $this->getAchievementByValidatorType($type);

        foreach ($modelsToCheck as $model) {
            if ($this->doesUserHaveAchievement($model)) {
                continue;
            }

            if ($this->isAchievementValidatorsRespected($model)) {
                $this->giveUserAchievement($model);
            }
        }
    }

    /**
     * Get achievement by the type of the validator
     * Mostly used by Achievement Listeners
     *
     * @param string $type
     * @return AchievementModel[]
     */
    private function getAchievementByValidatorType($type)
    {
        /** @var AchievementModel[] $achievementModels */
        $achievementModels = $this->container->get('doctrine')->getRepository(AchievementModel::class)->findAll();
        $achievements = array();

        foreach ($achievementModels as $model) {
            foreach ($model->getValidators() as $validator) {
                if ($this->container->get($validator->getService())->getType() == $type) {
                    $achievements[] = $model;
                    break;
                }
            }
        }

        return $achievements;
    }

    /**
     * Check if user already have the achievement
     *
     * @param AchievementModel $model
     * @return bool
     */
    private function doesUserHaveAchievement(AchievementModel $model)
    {
        $user = $this->container->get('app.business.user')->loadUser();

        foreach($user->getAchievements() as $achievement)
        {
            if($achievement->getModel()->getId() === $model->getId()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Give achievement to the current user without regarding validators
     *
     * @param AchievementModel $model
     */
    public function giveUserAchievement(AchievementModel $model)
    {
        if ($this->doesUserHaveAchievement($model)) {
            return;
        }

        $achievement = new Achievement();
        $user = $this->container->get('app.business.user')->loadUser();
        $user->addAchievement($achievement);
        $achievement->setModel($model);
        $this->container->get('app.socket.achievement')->sendAchievementNotification($model);
        $this->container->get('app.business.user')->saveUser($user);
    }

    /**
     * Check if current user respect achievement conditions
     *
     * @param AchievementModel $model
     * @return bool
     */
    public function isAchievementValidatorsRespected($model)
    {
        $isValid = true;
        $validators = $model->getValidators();
        foreach ($validators as $validator) {

            /** @var AchievementValidator $service */
            $service = $this->container->get($validator->getService());
            if (!$service->isValid($validator->getParameters())) {
                $isValid = false;
                break;
            }
        }

        return $isValid;
    }

    /**
     * Get current user achievements correctly loaded
     *
     * @return AchievementModel[]
     */
    public function getUserAchievements()
    {
        $user = $this->container->get('app.business.user')->loadUser();

        $achievements = $user->getAchievements();

        if($achievements instanceof PersistentCollection) {
            $achievements = $achievements->getValues();
        }

        return array_map(function(Achievement $achievement){
            return $achievement->getModel();
        }, $achievements);
    }

    public function getAchievementImageAssetPath(AchievementModel $model)
    {
        return null;
    }

    public function getRenderedAchievement(AchievementModel $model)
    {
        return $this->container->get('templating')->render('@Layout/Widget/Achievement/Default/base.html.twig', array(
            'achievement' => $model,
        ));
    }
}
