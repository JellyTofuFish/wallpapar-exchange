<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PictureFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
         $picture = (new Picture())
             ->setTitle('winter-image-1')
             ->setPicture('winter-animal.jpeg')
             ->setDescription('winter-animal')
             ->setUser($this->getReference('user.admin')
             );

        $picture1 = (new Picture())
            ->setTitle('winter-image-2')
            ->setPicture('winter-lake.jpeg')
            ->setDescription('winter-lake')
            ->setUser($this->getReference('user.admin')
            );

        $this->setReference('picture.winter1', $picture );
        $this->setReference('picture.winter2', $picture1 );
        $picture->addPictureCategory($this->getReference('category.winter'));
        $picture1->addPictureCategory($this->getReference('category.winter'));
        $manager->persist($picture);
        $manager->persist($picture1);

        $manager->flush();
    }

    public function getOrder()
    {
        return 200;
    }
}
