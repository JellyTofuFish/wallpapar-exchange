<?php

namespace App\Service;

class PictureFilePathHelper
{

    /**
     * @var string
     */
    private $pictureFileDirectory;

    /**
     * PictureFilePathHelper constructor.
     * @param string $pictureFileDirectory
     */
    public function __construct(string $pictureFileDirectory)
    {
        $this->pictureFileDirectory =  $this->ensureHasTrailingSlash($pictureFileDirectory);
    }

    /**
     * @param string $newFileName
     * @return string
     */
    public function getNewFilePath(string $newFileName)
    {
        $newFileName = $this->ensureHasNoLeadingSlash($newFileName);
        return $this->pictureFileDirectory. $newFileName;
    }
    private function ensureHasTrailingSlash(string $path)
    {
        if (substr($path, -1) === '/') {
            return $path;
        }
        return $path .'/';
    }
    private function ensureHasNoLeadingSlash(string $path)
    {
        if (substr($path, 0,1) === '/') {
            return substr($path, 1);
        }
        return $path;
    }
}