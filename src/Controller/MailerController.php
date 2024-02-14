<?php

// src/Controller/MailerController.php
namespace App\Controller;

use App\Form\MessageType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailerController extends AbstractController
{
    #[Route('/email', name:"email_contact")]
    public function sendEmail(MailerInterface $mailer, Request $request): Response
    {

       $form = $this->createForm(MessageType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
            $data = $form->getData();

            $email = (new Email())
            ->from($data["email"])
            ->to('mailtrap@testapi.com')
            ->subject($data["subject"])
            ->html($data["text"]);

            $this->addFlash('success', 'Message envoyé avec succés.');

            $mailer->send($email);
        
        }

        else{
            $this->addFlash('danger', 'Une erreur est survenue.');
        }


      
      

        return $this->render('email/email.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }
}