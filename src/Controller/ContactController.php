<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\MailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact.index')]
    public function index(
        Request $request, 
        EntityManagerInterface $manager,
        MailService $mailService
        ): Response
    {
        $contact = new Contact();
        if($this->getUser()) {
            $contact->setUsername($this->getUser()->getUsername());
            
        }
        $form = $this->createForm(ContactType::class, $contact);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            
            // dd($contact);
            $manager->persist($contact);
            $manager->flush();

            //Email
            $mailService->sendEmail(
                $contact->getSubject(),
                'emails/contact.html.twig',
                ['contact' => $contact ],
                'demo1@example.com',
                'admin1@example.com'
            );

            $this->addFlash(
                'success',
                'Votre demande a été envoyé'
            );
            return $this->redirectToRoute('contact.index');

        }
        
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
