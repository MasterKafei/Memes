<?php

namespace AppBundle\Service\Business;

use AppBundle\Entity\Achievement;
use AppBundle\Service\Util\AbstractContainerAware;
use AppBundle\Service\Validator\Achievement\AchievementValidator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Yaml\Yaml;

class AchievementBusiness extends AbstractContainerAware
{
    const LIKE_VOTE_TYPE = 'like_vote';
    const FAVORITE_VOTE_TYPE = 'favorite_vote';

    private $achievementsYamlPath;

    private $defaults = array(
        'name' => 'Untitled',
        'description' => 'No description',
        'image' => null,
        'reward' => array(
            'xp' => 0,
        ),
    );

    public function __construct()
    {
        $this->achievementsYamlPath = '@AppBundle/Resources/config/achievements/all.yml';
    }

    /**
     * Get achievement by identifier correctly loaded
     *
     * @param $identifier
     * @return Achievement
     */
    public function getAchievement($identifier)
    {
        $achievement = new Achievement($identifier);

        $optionResolver = new OptionsResolver();
        $optionResolver->setDefaults($this->defaults);

        $achievementArray = $this->getAchievementConfigByIdentifier($identifier);
        $option = $optionResolver->resolve($achievementArray);

        $achievement
            ->setName($option['name'])
            ->setDescription($option['description'])
            ->setImagePath($option['image'])
            ->setXp($option['reward']['xp']);

        return $achievement;
    }

    private function getAchievementsYaml()
    {
        return Yaml::parseFile($this->getRealPath($this->achievementsYamlPath));
    }

    /**
     * Get achievement yaml array
     *
     * @param $identifier
     * @return null
     */
    private function getAchievementYaml($identifier)
    {
        $achievements = $this->getAchievementsYaml();

        foreach ($achievements as $achievement) {
            if (intval($achievement['identifier']) == $identifier) {
                return $achievement;
            }
        }

        return null;
    }

    /**
     * Get achievement configuration array
     *
     * @param int $identifier
     * @return array
     */
    private function getAchievementConfigByIdentifier($identifier)
    {
        $achievement = $this->getAchievementYaml($identifier);

        if (null === $achievement) {
            return null;
        }

        return Yaml::parseFile($this->getRealPath($achievement['config']));
    }

    /**
     * Get real path of resource by namespace
     *
     * @param string $path
     * @return string
     */
    private function getRealPath($path)
    {
        return $this->container->get('file_locator')->locate($path);
    }

    /**
     * Check if current user respect achievement by validator type
     * Mostly used by Achievement Listeners
     *
     * @param string $type
     */
    public function checkAchievementByType($type)
    {
        $achievementsToCheck = $this->getAchievementByValidatorType($type);

        foreach ($achievementsToCheck as $achievementToCheck) {
            if ($this->doesUserHaveAchievement($achievementToCheck['identifier'])) {
                continue;
            }

            if ($this->isAchievementValidatorsRespected($achievementToCheck)) {
                $this->giveUserAchievement($achievementToCheck);
            }
        }
    }

    /**
     * Get achievement by the type of the validator
     * Mostly used by Achievement Listeners
     *
     * @param $type
     * @return array
     */
    private function getAchievementByValidatorType($type)
    {
        $allAchievements = $this->getAchievementsYaml();
        $achievements = array();

        foreach ($allAchievements as $achievement) {
            foreach ($achievement['validators'] as $service => $config) {
                if ($this->container->get($service)->getType() == $type) {
                    $achievements[] = $achievement;
                    break;
                }
            }
        }

        return $achievements;
    }

    /**
     * Check if user already have the achievement
     *
     * @param int $identifier
     * @return bool
     */
    private function doesUserHaveAchievement($identifier)
    {
        $user = $this->container->get('app.business.user')->loadUser();

        $achievements = $user->getAchievements();

        foreach ($achievements as $achievement) {
            if ($achievement->getIdentifier() == $identifier) {
                return true;
            }
        }

        return false;
    }

    /**
     * Give achievement to the current user without regarding validators
     *
     * @param $achievementYaml
     */
    public function giveUserAchievement($achievementYaml)
    {
        if ($this->doesUserHaveAchievement($achievementYaml)) {
            return;
        }

        $achievement = new Achievement($achievementYaml['identifier']);
        $user = $this->container->get('app.business.user')->loadUser();
        $user->addAchievement($achievement);
        $this->container->get('app.socket.achievement')->sendAchievementNotification($achievement->getIdentifier());
        $this->container->get('app.business.user')->saveUser($user);
    }

    /**
     * Check if current user respect achievement conditions
     *
     * @param array $achievement
     * @return bool
     */
    public function isAchievementValidatorsRespected($achievement)
    {
        $isValid = true;
        $validators = $achievement['validators'];
        foreach ($validators as $service => $config) {

            /** @var AchievementValidator $service */
            $service = $this->container->get($service);
            if (!$service->isValid($config['parameters'])) {
                $isValid = false;
                break;
            }
        }

        return $isValid;
    }

    /**
     * Get current user achievements correctly loaded
     *
     * @return Achievement[]
     */
    public function getUserAchievements()
    {
        $user = $this->container->get('app.business.user')->loadUser();
        $achievements = array();

        foreach ($user->getAchievements() as $achievement) {
            $achievements[] = $this->getAchievement($achievement->getIdentifier());
        }

        return $achievements;
    }

    public function saveAchievement(Achievement $achievement)
    {
        $achievementYaml = $this->getAchievementYaml($achievement->getIdentifier());
        $configPath = $this->getRealPath($achievementYaml['config']);
        $image = $achievement->getImage();

        if(null !== $image) {
            $imagePath = $this->saveAchievementImage($image);
            $achievement->setImagePath($imagePath);
        }

        $yaml = Yaml::dump($this->achievementToArray($achievement));
        file_put_contents($configPath, $yaml);
    }

    private function achievementToArray(Achievement $achievement)
    {
        return array(
            'name' => $achievement->getName(),
            'description' => $achievement->getDescription(),
            'image' => $achievement->getImagePath(),
            'reward' => array(
                'xp' => $achievement->getXp(),
            )
        );
    }

    private function saveAchievementImage(UploadedFile $image)
    {
        $fileName = md5(uniqid()) . '.' . $image->guessExtension();

        $image->move($this->container->getParameter('achievement.image.directory'), $fileName);

        return $fileName;
    }

    public function getAchievementImageAssetPath(Achievement $achievement)
    {
        return $this->container->getParameter('achievement.image.directory.web') . $achievement->getImagePath();
    }

    private function getAchievementTemplate($identifier)
    {
        return $this->getAchievementYaml($identifier)['template'];
    }

    public function getRenderedAchievement($identifier)
    {
        return $this->container->get('templating')->render($this->getAchievementTemplate($identifier), array('achievement' => $this->getAchievement($identifier)));
    }
}
