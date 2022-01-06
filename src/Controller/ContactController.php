<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of ContactController
 *
 * @author Xiaoxiao
 */
class ContactController extends AbstractController {

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function index(Request $request, \Swift_Mailer $mailer): Response {
        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);
        if ($formContact->isSubmitted() && $formContact->isValid()) {
            //envoi du mail
            $this->envoiMaiil($mailer, $contact);
            $this->addFlash('success', 'message envoyé');
            return $this->redirectToRoute('contact');
        }

        return $this->render("pages/contact.html.twig", [
                    'contact' => $contact,
                    'formcontact' => $formContact->createView()
        ]);
    }

    /**
     * 
     * @param \Swift_Mailer $mailer
     * @param Contact $contact
     */
    public function envoiMaiil(\Swift_Mailer $mailer, Contact $contact) {
        $message = (new \Swift_Message('Message du site de voyages'))
                ->setFrom($contact->getEmail())
                ->setTo('contact@mesvoyages.fr')
                ->setBody(
                $this->renderView(
                        // templates/emails/registration.html.twig
                        'pages/_email.html.twig',
                        ['contact' => $contact]
                ),
                'text/html'
                )
        ;
        $mailer->send($message);
    }

}
