<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Interaction;
use App\Form\InteractionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InteractionController extends AbstractController
{
    #[Route('/interaction/{id}', name: 'interaction')]
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


    #[Route('/add/interaction', name:'add_interaction', methods:['GET','POST'])]
    public function addInteraction(Request $request, EntityManagerInterface $manager): Response
    {
        $interaction = new Interaction();

        $form = $this->createForm(InteractionType::class, $interaction);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $interaction = $form->getData();

            $manager->persist($interaction);

            $manager->flush();

           
            return $this->redirectToRoute('app_contact');

        }


        return $this->render('interaction/add_interaction.html.twig', [
            'form' => $form
        ]);
        
    }


    #[Route('/delete/interaction/{id}', name:'delete_interaction', methods:['GET'])]
    public function deleteInteraction(Request $request, EntityManagerInterface $manager, Interaction $interaction): Response
    {

        $manager->remove($interaction);

        $manager->flush();

        return $this->redirectToRoute('app_contact');
    }
}
