<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class FileTransformer implements DataTransformerInterface
{
    /**
     * @param null $file
     * @return array
     * @var mixed|null $file
     */
    public function transform($file = null)
    {
        return [
            'file' => $file
        ];
    }

    /**
     * @var array $data
     * @return mixed
     */
    public function reverseTransform($data)
    {
        return $data['file'];
    }

}
