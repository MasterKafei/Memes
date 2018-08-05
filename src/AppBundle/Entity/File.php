<?php

namespace AppBundle\Entity;

use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Uploaded
 * @package AppBundle\Entity
 * @Vich\Uploadable
 */
class File
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     * @Vich\UploadableField(mapping="file", fileNameProperty="path")
     */
    private $file;

    /**
     * @var \DateTime
     */
    private $lastUpdate;

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
     * Set path
     *
     * @param string $path
     *
     * @return File
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return File
     */
    public function setFile($file)
    {
        $this->file = $file;

        if ($file) {
            $this->setLastUpdate(new \DateTime());
        }

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set lastUpdate.
     *
     * @param \DateTime $lastUpdate
     *
     * @return File
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get lastUpdate.
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }
}
