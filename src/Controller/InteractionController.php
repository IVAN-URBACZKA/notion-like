<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Interaction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InteractionController extends AbstractController
{
    #[Route('/interaction/{id}', name: 'add_interaction')]
    public function index(EntityManagerInterface $entityManager, Contact $contact ): Response
    {

        if($this->getUser()->getId() === $contact->getUser()->getId()){
            $interactions = $contact->getInteraction();
        }
        else {
            return $this->redirectToRoute('app_contact');
        }

        


    
        return $this->render('interaction/interaction.html.twig', [
            'interactions' => $interactions,
        ]);
    }
}
