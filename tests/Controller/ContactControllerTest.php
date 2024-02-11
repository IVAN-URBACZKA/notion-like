<?php

namespace App\Tests\Controller;
use App\Repository\UserRepository;
use Faker\Factory;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{

    public function testContactAdd(){

        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('jean@gmail.com');
        $client->loginUser($testUser);
        $client->request('GET', '/contact/add');
    
        $this->assertResponseIsSuccessful();
       

    }

       public function testCommentSubmission(){

        $faker = Factory::create();
  
         $client = static::createClient();
         $userRepository = static::getContainer()->get(UserRepository::class);
         $testUser = $userRepository->findOneByEmail('jean@gmail.com');
         $client->loginUser($testUser);
         $client->request('GET', '/contact/add');
         $client->submitForm('Submit', [
            'contact[name]' => 'Jean',
            'contact[firstName]' => 'kilucru',
            'contact[email]' => $faker->email(),
            'contact[tel]' => '0321225566',
        ]);
        $this->assertResponseRedirects();
        
        
    }


}