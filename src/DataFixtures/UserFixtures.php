<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
       
        $admin->setPassword('admin1234');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setEmail('google@gmail.com');

        $manager->persist($admin);

        $testeur = new User();

        $testeur->setPassword('testeur');
        $testeur->setRoles(['ROLE_USER']);
        $testeur->setEmail('testeur@test.fr');

        $manager->persist($testeur);

        $faker = Factory::create();

        $date = new \DateTimeImmutable();
        
        for ($i=0; $i < 5 ; $i++)
        {
        $user = new User();
        $user->setEmail($faker->email());
        $user->setPassword($faker->password());
        $user->setRoles(['ROLE_USER']);

        $manager->persist($user);
        }
        

        $manager->flush();
    }
}
