<?php

namespace saya25\LouvreBundle\Controller;

use saya25\LouvreBundle\Form\BilletType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use saya25\LouvreBundle\Entity\Commande;
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

        $billet = new Billet();
        $form = $this->createForm(BilletType::class, $billet);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($billet);
            $em->flush();

            return $this->redirectToRoute('saya25_louvre_billetterie', array('id' => $billet->getId()));
        }

        $listeBillets =  $this->getDoctrine()->getManager()->getRepository('saya25LouvreBundle:Billet')->findAll();

        return $this->render('saya25LouvreBundle:Ticket:billetterie.html.twig', array(
            'listeBillets' => $listeBillets,
            'form' => $form->createView(),
        ));
    }






     public function coordonneesAction()
    {
        return $this->render('saya25LouvreBundle:Ticket:coordonnees.html.twig');
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

