<?php

namespace saya25\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use saya25\LouvreBundle\Entity\Billet;
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

        $listeBillets =  $this->getDoctrine()->getManager()->getRepository('saya25LouvreBundle:Billet')->findAll();

        return $this->render('saya25LouvreBundle:Ticket:billetterie.html.twig', array(
            'listeBillets' => $listeBillets,
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

    public function deletebilletAction(Request $request)
    {
        $session = $request->getSession();
        $session->getId();
        $session->clear();
        return $this->redirectToRoute('saya25_louvre_billetterie');
    }


    public function paiementAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $token = $request->get('stripeToken');

            \Stripe\Stripe::setApiKey($this->getParameter("private_key"));

            \Stripe\Charge::create(array(
                "amount" => "",
                "currency" => "eur",
                "source" => $token,
                "description" => "First test charge!"
            ));

            $request->getSession()->getFlashBag()->add('info', 'Paiement accepté');
        }
        return $this->render('saya25LouvreBundle:Ticket:paiement.html.twig', array(
            'public_key' =>  $this->getParameter("public_key"),

        ));
    }

    public function confirmationAction()
    {
        return $this->render('saya25LouvreBundle:Ticket:confirmation.html.twig');
    }



}

