<?php

namespace AppBundle\Service\Util;


use Symfony\Component\Filesystem\Filesystem;

class Downloader
{
    public static function downloadFileFromUrl($url, $destination, $extension)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close ($ch);

        $name = md5(uniqid());
        self::createFolder($destination);
        $file = fopen($destination . $name . '.' . $extension, "w+");
        fputs($file, $data);
        fclose($file);

        return $name;
    }

    public static function createFolder($destination)
    {
        $fileSystem = new Filesystem();
        $fileSystem->mkdir($destination, 0700);
    }
}
