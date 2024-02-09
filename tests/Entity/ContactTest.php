<?php

namespace App\Tests\Entity;
use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase{

    public function testContact(){

        $contact  = new Contact();

        $name = "Jacques";
        $firstName = "Jean";
        $email = "Jacquot@gmail.com";
        $tel = "0321221122";

        $contact->setName($name);
        $contact->setFirstName($firstName);
        $contact->setEmail($email);
        $contact->setTel($tel);

        $this->assertEquals("Jacques", $contact->getName());
        $this->assertEquals("Alain", $contact->getFirstName());
        $this->assertEquals("Jacquot@gmail.com", $contact->getEmail());
        $this->assertEquals("0321221122", $contact->getTel());

    }

}