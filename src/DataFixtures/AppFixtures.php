<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class AppFixtures extends Fixture
{

    private $passwordHasher;

    public function __construct( UserPasswordHasherInterface $passwordHasher){
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        
            $plaintextPassword = "password";
        
            $faker = Factory::create();

            for ($i=0; $i <=50 ; $i++) { 
                $contact = new Contact();
                $contact->setName('jean');
                $contact->setFirstName($faker->firstNameMale());
                $contact->setEmail($faker->email());
                $contact->setTel("0321665522");
                $manager->persist($contact);
            
            }

            $manager->flush();

            $contact = new Contact();
            $contact->setName('jean');
            $contact->setFirstName($faker->firstNameMale());
            $contact->setEmail($faker->email());
            $contact->setTel("0321665522");
            
                $user = new User();
                $user->setEmail('johndoe@gmail.com');
                $user->setRoles(["ROLE_USER"]);
                $user->setPassword("password");
                $hashedPassword = $this->passwordHasher->hashPassword(
                    $user,
                    $plaintextPassword
                );
                $user->setPassword($hashedPassword);

              
                
             $manager->persist($user);
                $manager->flush();
            

            
    }
}
