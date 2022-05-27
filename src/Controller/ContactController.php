<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact.index')]
    public function index(
        Request $request, 
        EntityManagerInterface $manager,
        MailerInterface $mailer
        ): Response
    {
        $contact = new Contact();
        if($this->getUser()) {
            // dd($this->getUser());
            $contact->setUsername($this->getUser()->getUsername());

        }
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            // Email
            $email = (new TemplatedEmail())
            ->from('demo@example.com')
            ->to('admin@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($contact->getSubject())
            // ->text('Sending emails is fun again!')
            ->htmlTemplate('emails/contact.html.twig')
            ->context([
                'contact' => $contact
            ])
            ;
        $mailer->send($email);

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
