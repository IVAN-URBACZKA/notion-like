<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {

        $contacts = $entityManager->getRepository(Contact::class)->findAll();

        $contacts = $paginator->paginate(
            $contacts, 
            $request->query->getInt('page', 1), 
            10 
        );


        return $this->render('contact/contact.html.twig', [
            'contacts' => $contacts,
            
        ]);
    }

    #[Route('/contact/add', name:'app_contact_add', methods: ['GET','POST'])]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);


        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            
            $contact = $form->getData();

            $manager->persist($contact);

            $manager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/form_add.html.twig', [
            'form' => $form,
        ]);
    }
}
