<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;

class PictureFileDeleter {

    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var string
     */
    private $filePath;

    public function __construct(Filesystem $filesystem, string $filePath)
    {
        $this->filesystem = $filesystem;
        $this->filePath = $filePath;
    }

    public function delete(string $pathToFIle)
    {
        $this->filesystem->remove(
            $this->filePath . '/'. $pathToFIle
        );
    }

}