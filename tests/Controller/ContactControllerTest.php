<?php

namespace App\Tests\Controller;
use App\Repository\UserRepository;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{

    public function testContactAdd(){

        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('heloise.medhurst@halvorson.com');
        $client->loginUser($testUser);
        $client->request('GET', '/contact/add');
    
        $this->assertResponseIsSuccessful();
       

    }

       public function testCommentSubmission(){
  
         $client = static::createClient();
         $userRepository = static::getContainer()->get(UserRepository::class);
         $testUser = $userRepository->findOneByEmail('heloise.medhurst@halvorson.com');
         $client->loginUser($testUser);
         $client->request('GET', '/contact/add');
         $client->submitForm('Submit', [
            'contact[name]' => 'Jbl',
            'contact[firstName]' => 'kilucru',
            'contact[email]' => 'kilucru2@gmail.com',
            'contact[tel]' => '0321225566',
        ]);
        $this->assertResponseRedirects();
        
        
    }


}