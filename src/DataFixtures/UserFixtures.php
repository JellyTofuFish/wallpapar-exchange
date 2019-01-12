<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
  private $passwordEncoder;
  public function __construct(UserPasswordEncoderInterface $passwordEncoder)
  {
      $this->passwordEncoder = $passwordEncoder;
  }

    public function load(ObjectManager $manager)
    {

        $roles[] = 'ROLE_ADMIN';
        $date= \DateTime::createFromFormat('U', time());
        $user = new User();
        $user->setEmail("admin@example.net");
        $user->setUsername('example');
        $user->setFirstName("example");
        $user->setLastName("example");
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'example'));
        $user->setPoints(99999);
        $user->setLastDateOnline($date);
        $user->setRoles($roles);
        $this->addReference('user.admin',$user );

        $roles2[] = 'ROLE_USER';
        $user2 = new User();
        $user2->setEmail("user@example.net");
        $user2->setUsername('example2');
        $user2->setFirstName("example");
        $user2->setLastName("example");
        $user2->setPassword($this->passwordEncoder->encodePassword($user, 'example'));
        $user2->setPoints(20);
        $user2->setLastDateOnline($date);
        $user2->setRoles($roles2);
        $this->addReference('user.user',$user2 );

        $manager->persist($user);
        $manager->persist($user2);
        $manager->flush();
    }
    public function getOrder()
    {
        return 100;
    }
}
