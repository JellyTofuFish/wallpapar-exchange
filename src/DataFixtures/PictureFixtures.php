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
        $picture->addPictureCategory($this->getReference('category.winter'));

        $picture1 = (new Picture())
            ->setTitle('winter-image-2')
            ->setPicture('winter-lake.jpeg')
            ->setDescription('winter-lake')
            ->setUser($this->getReference('user.admin')
            );
        $picture1->addPictureCategory($this->getReference('category.winter'));

        $picture2 = (new Picture())
            ->setTitle('winter-image-3')
            ->setPicture('winter-forrest.jpeg')
            ->setDescription('winter-forrest')
            ->setUser($this->getReference('user.admin')
            );
        $picture2->addPictureCategory($this->getReference('category.winter'));

        $picture3 = (new Picture())
            ->setTitle('winter-image-4')
            ->setPicture('winter-overview.jpeg')
            ->setDescription('winter-overview')
            ->setUser($this->getReference('user.admin')
            );
        $picture3->addPictureCategory($this->getReference('category.winter'));

        $picture18 = (new Picture())
            ->setTitle('winter-image-5')
            ->setPicture('winter-road.jpeg')
            ->setDescription('winter-road')
            ->setUser($this->getReference('user.admin')
            );
        $picture18->addPictureCategory($this->getReference('category.winter'));

        $picture19 = (new Picture())
            ->setTitle('winter-image-6')
            ->setPicture('winter-city.jpeg')
            ->setDescription('winter-city')
            ->setUser($this->getReference('user.admin')
            );
        $picture19->addPictureCategory($this->getReference('category.winter'));

        $picture4 = (new Picture())
            ->setTitle('landscape-image-1')
            ->setPicture('landscape-river.jpeg')
            ->setDescription('landscape-river')
            ->setUser($this->getReference('user.admin')
            );
        $picture4->addPictureCategory($this->getReference('category.landscape'));

        $picture5 = (new Picture())
            ->setTitle('landscape-image-2')
            ->setPicture('landscape-mountain.jpeg')
            ->setDescription('landscape-mountain')
            ->setUser($this->getReference('user.admin')
            );
        $picture5->addPictureCategory($this->getReference('category.landscape'));

        $picture6 = (new Picture())
            ->setTitle('landscape-image-3')
            ->setPicture('landscape-lake.jpeg')
            ->setDescription('landscape-lake')
            ->setUser($this->getReference('user.admin')
            );
        $picture6->addPictureCategory($this->getReference('category.landscape'));

        $picture7 = (new Picture())
            ->setTitle('landscape-image-4')
            ->setPicture('landscape-grassfield.jpeg')
            ->setDescription('landscape-grassfield')
            ->setUser($this->getReference('user.admin')
            );
        $picture7->addPictureCategory($this->getReference('category.landscape'));

        $picture8 = (new Picture())
            ->setTitle('landscape-image-5')
            ->setPicture('landscape-forrest-fog.jpeg')
            ->setDescription('landscape-forrest-fog')
            ->setUser($this->getReference('user.admin')
            );
        $picture8->addPictureCategory($this->getReference('category.landscape'));

        $picture9 = (new Picture())
            ->setTitle('landscape-image-6')
            ->setPicture('landscape-forrest.jpeg')
            ->setDescription('landscape-forrest')
            ->setUser($this->getReference('user.admin')
            );
        $picture9->addPictureCategory($this->getReference('category.landscape'));

        $picture10 = (new Picture())
            ->setTitle('landscape-image-7')
            ->setPicture('landscape-cropland.jpeg')
            ->setDescription('landscape-cropland')
            ->setUser($this->getReference('user.admin')
            );
        $picture10->addPictureCategory($this->getReference('category.landscape'));

        $picture11 = (new Picture())
            ->setTitle('landscape-image-8')
            ->setPicture('landscape-field.jpg')
            ->setDescription('landscape-field')
            ->setUser($this->getReference('user.admin')
            );
        $picture11->addPictureCategory($this->getReference('category.landscape'));

        $picture12 = (new Picture())
            ->setTitle('interiordesign-image-1')
            ->setPicture('interiordesign-wood.jpg')
            ->setDescription('interiordesign-wood')
            ->setUser($this->getReference('user.admin')
            );
        $picture12->addPictureCategory($this->getReference('category.interior_design'));

        $picture13 = (new Picture())
            ->setTitle('interiordesign-image-2')
            ->setPicture('interiordesign-white.jpeg')
            ->setDescription('interiordesign-white')
            ->setUser($this->getReference('user.admin')
            );
        $picture13->addPictureCategory($this->getReference('category.interior_design'));

        $picture14 = (new Picture())
            ->setTitle('interiordesign-image-3')
            ->setPicture('interiordesign-relaxing-corner.jpeg')
            ->setDescription('interiordesign-relaxing-corner')
            ->setUser($this->getReference('user.admin')
            );
        $picture14->addPictureCategory($this->getReference('category.interior_design'));

        $picture15 = (new Picture())
            ->setTitle('interiordesign-image-4')
            ->setPicture('interiordesign-paintings.jpeg')
            ->setDescription('interiordesign-paintings')
            ->setUser($this->getReference('user.admin')
            );
        $picture15->addPictureCategory($this->getReference('category.interior_design'));

        $picture16 = (new Picture())
            ->setTitle('interiordesign-image-5')
            ->setPicture('interiordesign-brown-grey.jpeg')
            ->setDescription('interiordesign-brown-grey')
            ->setUser($this->getReference('user.admin')
            );
        $picture16->addPictureCategory($this->getReference('category.interior_design'));

        $picture17 = (new Picture())
            ->setTitle('interiordesign-image-6')
            ->setPicture('interiordesign-bathroom.jpeg')
            ->setDescription('interiordesign-bathroom')
            ->setUser($this->getReference('user.user')
            );
        $picture17->addPictureCategory($this->getReference('category.interior_design'));


        $this->setReference('picture.winter1', $picture );
        $this->setReference('picture.winter2', $picture1 );

        $manager->persist($picture);
        $manager->persist($picture1);
        $manager->persist($picture2);
        $manager->persist($picture3);
        $manager->persist($picture4);
        $manager->persist($picture5);
        $manager->persist($picture6);
        $manager->persist($picture7);
        $manager->persist($picture8);
        $manager->persist($picture9);
        $manager->persist($picture10);
        $manager->persist($picture11);
        $manager->persist($picture12);
        $manager->persist($picture13);
        $manager->persist($picture14);
        $manager->persist($picture15);
        $manager->persist($picture16);
        $manager->persist($picture17);
        $manager->persist($picture18);
        $manager->persist($picture19);

        $manager->flush();
    }

    public function getOrder()
    {
        return 200;
    }
}
