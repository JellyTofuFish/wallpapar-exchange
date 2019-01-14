<?php

namespace App\Event\Listener;

use App\Entity\Comment;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\Event\LifecycleEventArgs;

Class commentListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if (false === $entity instanceof Comment)
        {
            return false;
        }
        $user = $this->security->getUser();
        $entity
            ->setUser(
                $user
            );

        return true;

    }
}