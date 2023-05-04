<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Review;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ReviewFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $date = new \DateTimeImmutable();
        
        for ($i=0; $i < 5 ; $i++) { 
        $review = new Review();

        $review->setMessage($faker->text());
        $review->setRating($faker->numberBetween(1,5));
        $review->setCreatedAt($date);
        $manager->persist($review);
        
        }

        $manager->flush();
    }
}
