<?php


namespace AppBundle\Service\Validator\Achievement;


interface AchievementValidator
{
    public function isValid($parameters);

    public function getType();
}