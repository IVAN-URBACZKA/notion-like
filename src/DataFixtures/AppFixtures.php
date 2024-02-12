<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Interaction;
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

        $user = new User();
        $user->setEmail("jean@gmail.com");
        $user->setRoles(["ROLE_USER"]);  
                
        $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
                );
        $user->setPassword($hashedPassword);
    
        $contact = new Contact();
        $contact->setName('jean');
        $contact->setFirstName($faker->firstNameMale());
        $contact->setEmail($faker->email());
        $contact->setTel("0321665522");
        $contact->setUser($user);

        $interaction = (new Interaction())
                    ->setTypeInteraction(Interaction::EMAIL)
                    ->setReport('Prospect à rappeler au plus vite')
                    ->setPriority('Important')
                    ->setStatut("En cours")
                    ->setContact($contact);

        $manager->persist($contact);
        $manager->persist($user);
        $manager->persist($interaction);

      


        
            
        $manager->flush();

    }
}
