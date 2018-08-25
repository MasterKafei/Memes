<?php

namespace AppBundle\Service\Business;


use AppBundle\Service\Util\AbstractContainerAware;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Yaml\Yaml;

class LevelBusiness extends AbstractContainerAware
{

    private $levelDefaultConfigurationPath;
    private $levelAllConfigurationPath;

    public function __construct()
    {
        $this->levelDefaultConfigurationPath = '@AppBundle\Resources\config\level\default.yml';
        $this->levelAllConfigurationPath = '@AppBundle\Resources\config\level\all.yml';
    }

    /**
     * Get avatars of current user.
     *
     *
     */
    public function getUserAvatars()
    {
        $user = $this->container->get('app.business.user')->loadUser();

        return $this->getAvatarsByLevel($user->getLevel());
    }

    /**
     * Get all configuration of levels.
     *
     * @return array
     */
    private function getLevelsYaml()
    {
        $levels = Yaml::parseFile($this->getRealPath($this->levelAllConfigurationPath));

        $resolver = new OptionsResolver();
        $resolver->setDefaults($this->getDefaultLevelConfigurationYaml());

        $calculatedLevels = array();

        foreach ($levels as $level) {
            $calculatedLevels[] = $resolver->resolve($level);
        }

        return $calculatedLevels;
    }

    /**
     * Get the default configuration of level.
     *
     * @return array
     */
    private function getDefaultLevelConfigurationYaml()
    {
        return Yaml::parseFile($this->getRealPath($this->levelDefaultConfigurationPath));
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

    private function getConfigurationByLevel($level)
    {
        $levelConfiguration = $this->getLevelsYaml();
        $matchingLevel = array();
        foreach ($levelConfiguration as $value) {
            if ($value['level'] <= $level) {
                $matchingLevel[] = $value;
            }
        }

        return $matchingLevel;
    }

    private function getAvatarsByLevel($level)
    {
        $levels = $this->getConfigurationByLevel($level);
        $avatars = array();
        foreach ($levels as $level) {
            $avatars = array_merge($avatars, $level['avatar']);
        }

        return $avatars;
    }

}
