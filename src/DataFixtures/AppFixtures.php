<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder= $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for($i = 0;$i<10;$i++)
        {
            $user = new User();
            $user->setEmail(sprintf('user-%d@example.com',$i));
            $user->setAge(rand(18,83));
            $user->setUsername(sprintf('User %d',$i));
            $user->setFirstName(sprintf('First Name %d',$i));
            $user->setLastName(sprintf('Last Name %d',$i));
            $user->setPassword($this->passwordEncoder->encodePassword($user,'password'));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
