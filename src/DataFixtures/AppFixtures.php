<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

            $faker = Factory::create();

            for ($i=0; $i <=50 ; $i++) { 
                $contact = new Contact();
                $contact->setName('jean');
                $contact->setFirstName($faker->firstNameMale());
                $contact->setEmail("jean@gmail.com");
                $contact->setTel("0321665522");
                $manager->persist($contact);
            
            }

            $manager->flush();


            
                $user = new User();
                $user->setEmail('johndoe@gmail.com');
                $user->setRoles(["ROLE_USER"]);
                $user->setPassword('password');
                $manager->persist($user);
                $manager->flush();
            

            
    }
}
