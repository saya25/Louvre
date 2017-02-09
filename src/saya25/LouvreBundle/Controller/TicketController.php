<?php

namespace saya25\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class TicketController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function accueilAction()
    {
        return $this->render('saya25LouvreBundle:Ticket:accueil.html.twig');
    }


    public function billetterieAction(Request $request)
    {
        $form = $this->get("core.back")->startCommande($request);

        return $this->render('saya25LouvreBundle:Ticket:billetterie.html.twig', array(

            'form' => $form->createView(),

        ));
    }

    public function commandeAction(Request $request)
    {
        $form = $this->get("core.back")->coordonneesCommande($request);

        return $this->render('saya25LouvreBundle:Ticket:commande.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function paiementAction(Request $request)
    {
        $commande = $this->get("core.back")->paiementCommande();
        $ticket = $this->get('core.back')->getAllTicketsByDate();

        if ($request->isMethod('POST')) {
            $token = $request->get('stripeToken');

            \Stripe\Stripe::setApiKey($this->getParameter("private_key"));

            \Stripe\Charge::create(array(
                "amount" => $commande->getTotal()*100,
                "currency" => "EUR",
                "source" => $token,
                "description" => "First test charge!"
            ));
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute('saya25_louvre_confirmation');

        }
        return $this->render('saya25LouvreBundle:Ticket:paiement.html.twig', array(
            'commande'  => $commande,
            'public_key' =>  $this->getParameter("public_key"),
            'ticket'    => $ticket,
        ));
    }



    public function confirmationAction()
    {
        $this->get('app.mail')->sendMail();
        $commande = $this->get("core.back")->confirmationCommande();

        return $this->render('saya25LouvreBundle:Ticket:confirmation.html.twig', array(
            'commande'  => $commande,
        ));
    }


    public function contactAction()
    {
        return $this->render('saya25LouvreBundle:Ticket:contact.html.twig');
    }

    public function mentionslegalesAction()
    {
        return $this->render('saya25LouvreBundle:Ticket:mentionslegales.html.twig');
    }

    public function deletebilletAction(Request $request)
    {
        $session = $request->getSession();
        $session->getId();
        $session->clear();
        return $this->redirectToRoute('saya25_louvre_billetterie');
    }



}

