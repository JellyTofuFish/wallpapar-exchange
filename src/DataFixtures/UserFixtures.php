<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
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
        $user->setEmail("new@example.net");
        $user->setUsername('example');
        $user->setFirstName("example");
        $user->setLastName("example");
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'example'));
        $user->setPoints(20);
        $user->setLastDateOnline($date);
        $user->setRoles($roles);

        $manager->persist($user);
        $manager->flush();
    }

}
