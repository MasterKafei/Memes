<?php

namespace AppBundle\Entity;

/**
 * Setting
 */
class Setting
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $numberByLine = 4;

    /**
     * @var int
     */
    private $numberByPage = 50;

    /**
     * @var int
     */
    private $importCode;


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
     * Set numberByLine.
     *
     * @param int $numberByLine
     *
     * @return Setting
     */
    public function setNumberByLine($numberByLine)
    {
        $this->numberByLine = $numberByLine;

        return $this;
    }

    /**
     * Get numberByLine.
     *
     * @return int
     */
    public function getNumberByLine()
    {
        return $this->numberByLine;
    }

    /**
     * Set numberByPage.
     *
     * @param int $numberByPage
     *
     * @return Setting
     */
    public function setNumberByPage($numberByPage)
    {
        $this->numberByPage = $numberByPage;

        return $this;
    }

    /**
     * Get numberByPage.
     *
     * @return int
     */
    public function getNumberByPage()
    {
        return $this->numberByPage;
    }

    /**
     * Set importCode.
     *
     * @param int $importCode
     *
     * @return Setting
     */
    public function setImportCode($importCode)
    {
        $this->importCode = $importCode;

        return $this;
    }

    /**
     * Get importCode.
     *
     * @return int
     */
    public function getImportCode()
    {
        return $this->importCode;
    }
}
