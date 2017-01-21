<?php

namespace saya25\LouvreBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use saya25\LouvreBundle\Form\CommandeBilletType;
use saya25\LouvreBundle\Form\CommandeType;
use saya25\LouvreBundle\Form\Billet;
use saya25\LouvreBundle\Entity\Commande;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Created by PhpStorm.
 * User: clement
 * Date: 13/12/2016
 * Time: 10:35
 */
class Back
{

    /**
     * @var EntityManager
     */
    protected $doctrine;

    /**
     * @var FormFactory
     */
    protected $form;

    /**
     * @var Session
     */
    protected $session;


    /**
     * @var Price
     */
    protected $price;


    /**
     * @var Router
     */
    protected $router;


    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session, Price $price, Router $router)
    {
        $this->doctrine = $doctrine;
        $this->form  = $form;
        $this->session = $session;
        $this->price = $price;
        $this->router = $router;
    }


    public function getTicketsSaved()
    {
        return count($this->doctrine->getRepository('saya25LouvreBundle:Billet')->findAll());
    }



    public function startCommande(Request $request)
    {

        $commande = new Commande();

        $form = $this->form->create(CommandeBilletType::class, $commande);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $data = $form->getData();
            $this->session->set('commande', $data);
        }
        return $form;

    }


    public function coordonneesCommande(Request $request)
    {
        $commande= $this->session->get('commande');
        $form = $this->form->create(CommandeType::class, $commande);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

                $this->price->tarifBillet($commande);

                $response = new RedirectResponse('paiement');
                $response->send();

        }
       return $form;
    }

    public function paiementCommande()
    {
        $commande = $this->session->get('commande');

        return $commande;
    }

    public function confirmationCommande()
    {
        $commande = $this->session->get('commande');

        return $commande;
    }



}


