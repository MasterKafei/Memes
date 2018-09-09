<?php

namespace AppBundle\Entity;

use GuzzleHttp\Psr7\UploadedFile;

/**
 * AchievementModel
 */
class AchievementModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var Image
     */
    private $image;

    /**
     * @var Validator[]
     */
    private $validators;

    /**
     * @var Reward
     */
    private $reward;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return AchievementModel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return AchievementModel
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get image.
     *
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image.
     *
     * @param UploadedFile $image
     *
     * @return AchievementModel
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get validators.
     *
     * @return Validator[]
     */
    public function getValidators()
    {
        return $this->validators;
    }

    /**
     * Set validators.
     *
     * @param Validator[] $validators
     *
     * @return AchievementModel
     */
    public function setValidators($validators)
    {
        $this->validators = $validators;

        return $this;
    }

    public function addValidator($validator)
    {
        $this->validators[] = $validator;

        return $this;
    }

    /**
     * Get reward.
     *
     * @return Reward
     */
    public function getReward()
    {
        return $this->reward;
    }

    /**
     * Set reward.
     *
     * @param $reward
     *
     * @return AchievementModel
     */
    public function setReward($reward)
    {
        $this->reward = $reward;

        return $this;
    }
}