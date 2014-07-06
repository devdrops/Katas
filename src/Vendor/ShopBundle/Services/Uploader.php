<?php

namespace Vendor\ShopBundle\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;

class Uploader
{
    private $filesystem;
    private $path;

    public function __construct(Filesystem $filesystem, $path)
    {
        $this->filesystem = $filesystem;
        $this->path = $path;
    }

    /**
     * Uploads files.
     *
     * @param UploadedFile $file
     *
     * @return string | boolean
     */
    public function upload(UploadedFile $file)
    {
        $name = md5(uniqid()).'.'.$file->guessExtension();

        try {
            $file = $file->move(__DIR__.'/../../../../web'.$this->path, $name);

        } catch (\InvalidArgumentException $e) {
            $this->filesystem->mkdir($this->path);
        } catch (\Exception $exception) {
            return false;
        }

        return $name;
    }
}
