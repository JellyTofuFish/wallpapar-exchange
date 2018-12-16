<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();

        $user = new User();
        $user->setEmail("new@example.net");
        $user->setFirstName("example");
        $user->setPassword("example");
        $manager->persist($user);
        $manager->flush();
    }

}
