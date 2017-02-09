<?php

namespace tests\Entity;

use saya25\LouvreBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class EntityCommandeTest extends TestCase
{

    public function testSetNom()
    {

    $commande = new Commande();
    $commande->setNom("MICHELIN");
    $this->assertEquals("MICHELIN", $commande->getNom());
    }

    public function testSetPrenom()
    {
    $commande = new Commande();
    $commande->setPrenom("Clément");
    $this->assertEquals("Clément", $commande->getPrenom());
    }


    public function testSetMail()
    {
    $commande = new Commande();
    $commande->setEmail("test@gmail.com");
    $this->assertEquals("test@gmail.com", $commande->getEmail());
    }


    public function testDateCommande()
    {
    $commande = new Commande();
    $date_actuelle = new \DateTime();
    $commande->setDateCommande($date_actuelle);
    $this->assertEquals($date_actuelle, $commande->getDateCommande());
    }


    public function testDateEntree()
    {
    $commande = new Commande();
    $date_entree = new \DateTime('18-12-2017');
    $commande->setDateEntree($date_entree);

    $this->assertEquals($date_entree, $commande->getDateEntree());
    }

    public function testSetTotal()
    {
    $commande = new Commande();
    $commande->setTotal(42.00);

    $this->assertEquals(42.00, $commande->getTotal());
    }

}