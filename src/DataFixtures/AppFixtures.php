<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

            $faker = Factory::create();

            for ($i=0; $i <=10 ; $i++) { 
                $contact = new Contact();
                $contact->setName($faker->name());
                $contact->setFirstName($faker->firstNameMale());
                $contact->setEmail($faker->email());
                $contact->setTel("0321665522");
                $manager->persist($contact);
            
            }

            $manager->flush();
    }
}
