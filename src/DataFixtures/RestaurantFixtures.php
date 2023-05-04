<?php

namespace App\DataFixtures;

use Faker;
use DateTimeImmutable;
use App\Entity\Restaurant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;



class RestaurantFixtures extends Fixture
{

   

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        $date = new DateTimeImmutable();
        
        for ($i=0; $i < 5 ; $i++) { 
        $restaurant = new Restaurant();

        $restaurant->setName($faker->name());
        $restaurant->setDescription($faker->text());
        $restaurant->setCreatedAt($date);
        $manager->persist($restaurant);
        }

        

        $manager->flush();
        }
}
