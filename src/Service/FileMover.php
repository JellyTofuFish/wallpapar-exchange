<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;

class FileMover {

    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $fs)
    {
        $this->filesystem = $fs;
    }

    public function move($existingFilePath, $newFilePath) {
        $this->filesystem->rename($existingFilePath, $newFilePath);

        return true;
    }

}
