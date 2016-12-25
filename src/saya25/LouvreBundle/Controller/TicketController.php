<?php

namespace saya25\LouvreBundle\Controller;

use saya25\LouvreBundle\Form\BilletType;
use saya25\LouvreBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use saya25\LouvreBundle\Entity\Commande;
use saya25\LouvreBundle\Entity\Billet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $billet = new billet();
        $form = $this->createForm(BilletType::class, $billet);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $this->get('session')->set('ticket', $billet);
            return $this->redirectToRoute('saya25_louvre_billetterie', array('id' => $billet->getId()));
        }

        $listeBillets =  $this->getDoctrine()->getManager()->getRepository('saya25LouvreBundle:Billet')->findAll();

        return $this->render('saya25LouvreBundle:Ticket:billetterie.html.twig', array(
            'listeBillets' => $listeBillets,
            'form' => $form->createView(),
        ));
    }

    public function commandeAction (Request $request) {

        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $billet = $this->get('session')->get('ticket');

                $commande->addBillet($billet);
                $this->get('session')->set('commande', $commande);

            return $this->redirectToRoute('saya25_louvre_paiement');
        }


        return $this->render('saya25LouvreBundle:Ticket:commande.html.twig', array (

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




    public function paiementAction()
    {
        return $this->render('saya25LouvreBundle:Ticket:paiement.html.twig');
    }
     public function confirmationAction()
    {
        return $this->render('saya25LouvreBundle:Ticket:confirmation.html.twig');
    }
}

