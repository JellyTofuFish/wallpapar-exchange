<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CommentFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $date= \DateTime::createFromFormat('U', time());
        $comment = (new Comment())
             ->setComment('this the unique comment')
             ->setDate($date)
             ->setPicture($this->getReference('picture.winter2'))
             ->setUser($this->getReference('user.admin'));
        $comment2 = (new Comment())
            ->setComment('this is my new comment1')
            ->setDate($date)
            ->setPicture($this->getReference('picture.winter1'))
            ->setUser($this->getReference('user.admin'));

        $comment3 = (new Comment())
            ->setComment('this is my new comment2')
            ->setDate($date)
            ->setPicture($this->getReference('picture.winter1'))
            ->setUser($this->getReference('user.user'));

        $manager->persist($comment);
        $manager->persist($comment2);
        $manager->persist($comment3);

        $manager->flush();
    }
    public function getOrder() {
        return 300;
    }
}
