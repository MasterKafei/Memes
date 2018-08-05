<?php

namespace AppBundle\Controller\Uploaded;

use AppBundle\Entity\Content;
use AppBundle\Entity\Uploaded;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vich\UploaderBundle\Storage\FileSystemStorage;

class DownloadingController extends Controller
{
    public function downloadContentAction(FileSystemStorage $fileSystemStorage, Uploaded $uploaded)
    {
        return $this->file($fileSystemStorage->resolvePath($uploaded->getFile(), 'file'));
    }
}
