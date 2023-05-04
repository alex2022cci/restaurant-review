<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\City;



use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        

        for ($i=0; $i < 10 ; $i++) { 

            $city = new City();

            $city->setName($faker->city());
            $city->setZipCode($faker->randomNumber(5, true));
            
            $manager->persist($city);
        }


        // ;

        $manager->flush();
    }
}
