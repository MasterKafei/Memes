<?php

namespace AppBundle\Entity;


abstract class Uploaded extends Content
{
    /**
     * @var File
     */
    private $file;

    /*** Get file.
     *
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set file.
     *
     * @param File $file
     *
     * @return Uploaded
     */
    public function setFile(File $file)
    {
        $this->file = $file;

        return $this;
    }

}