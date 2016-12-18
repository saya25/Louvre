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

        $commande = new Commande();
        $billet = new billet();
        $form = $this->createForm(BilletType::class, $billet);



        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $commande->addBillet($billet);
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
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

