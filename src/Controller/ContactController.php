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

        if(!$user = $this->getUser()){
            return $this->redirectToRoute('app_login');
        }
        else {
            $user = $this->getUser()->getId();
        }

        $contacts = $entityManager->getRepository(Contact::class)->findBy(['user'=>$user]);


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

        $user = $this->getUser();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $contact = $form->getData();

            $contact->setUser($user);

            $manager->persist($contact);

            $manager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/form_add.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/contact/update/{id}', name:'app_contact_update', methods:['GET', 'Post'])]
    public function updateContact(Request $request, EntityManagerInterface $manager, Contact $contact): Response
    {
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

    #[Route('/contact/delete/{id}', name:'app_contact_delete', methods:['GET'])]
    public function deleteContact(Request $request, EntityManagerInterface $manager, Contact $contact): Response
    {

        $manager->remove($contact);

        $manager->flush();

        return $this->redirectToRoute('app_home');

    }

    #[Route('/contact/export/csv', name:'app_export_csv')]
    public function exportCsv(EntityManagerInterface $entityManager, Request $request): Response
    {

        if(!$user = $this->getUser()){
            return $this->redirectToRoute('app_login');
        }
        else {
            $user = $this->getUser()->getId();
        }

        $contacts = $entityManager->getRepository(Contact::class)->findBy(['user'=>$user]);

        $myExportCSV = "Id; Nom; Prenom; Email; Telephone \n";

        foreach ($contacts as $contact) {
            $myExportCSV .= "{$contact->getId()}; {$contact->getName()}; {$contact->getFirstName()}; {$contact->getEmail()}; {$contact->getTel()} \n";
        }
        
        return new Response(
            $myExportCSV,
            200,
            [
              'Content-Type' => 'application/vnd.ms-excel',
              "Content-disposition" => "attachment; filename=contact.csv"
           ]
     );

    }
}
