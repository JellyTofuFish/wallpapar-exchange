<?php

namespace App\Event\Listener;

use App\Entity\Picture;
use App\Service\FileMover;
use App\Service\PictureFileDeleter;
use App\Service\PictureFilePathHelper;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping\PreRemove;
use Symfony\Component\Security\Core\Security;


Class pictureUploadListener
{
    /**
     * @var FileMover
     */
    private $filemover;

    /**
     * @var PictureFilePathHelper
     */
    private $pictureFilePathHelper;

    private $security;

    /**
     * @var PictureFileDeleter
     */
    private $deleter;

    public function __construct(FileMover $fileMover, PictureFilePathHelper $pictureFilePathHelper, Security $security, PictureFileDeleter $deleter)
    {
        $this->filemover = $fileMover;
        $this->pictureFilePathHelper = $pictureFilePathHelper;
        $this->security = $security;
        $this->deleter = $deleter;
    }
    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        $this->upload($entity);

    }
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
    }
    public function preRemove(LifecycleEventArgs $eventArgs)
    {
        /**
         * @var $entity Picture
         */
        $entity = $eventArgs->getEntity();
        if (false === $entity instanceof Picture)
        {
            return false;
        }

        $entity->setFile(null);
        $this->deleter->delete(
            $entity->getPicture()
        );

    }

    private function upload($entity)
    {
        if (false === $entity instanceof Picture)
        {
            return false;
        }
        /**
         * @var $entity Picture
         */
        $file = $entity->getFile();

        $temporaryLocation= $file->getPathname();

        $newFileLocation = $this->pictureFilePathHelper->getNewFilePath($file->getClientOriginalName());

        $this->filemover->move($temporaryLocation, $newFileLocation);

        /**
         * @var \App\Entity\User $user
         */
        $user = $this->security->getUser();
        $entity
            ->setPicture(
                $file->getClientOriginalName()
            )
            ->setUser(
                $user
            );

        return true;
    }
}