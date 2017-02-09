<?php

namespace tests\Entity;

use saya25\LouvreBundle\Entity\Billet;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class EntityBilletTest extends TestCase
{

    public function testSetNomBillet()
    {
        $billet = new Billet();
        $billet->setNom("MICHELIN");

        $this->assertEquals("MICHELIN", $billet->getNom());
    }

    public function testSetPrenomBillet()
    {
        $billet = new Billet();
        $billet->setPrenom("Clément");

        $this->assertEquals("Clément", $billet->getPrenom());
    }

    public function testSetPays()
    {
        $billet = new Billet();
        $billet->setPays("France");

        $this->assertEquals("France", $billet->getPays());
    }

    public function testSetDateNaissance()
    {
        $billet = new Billet();
        $dateNaissance = new\ DateTime("20-10-2015");
        $billet->setDateNaissance($dateNaissance);

        $this->assertEquals($dateNaissance, $billet->getDateNaissance());
    }

    public function testSetStatusTrue()
    {
        $billet = new Billet();
        $billet->setStatus(true);

        $this->assertEquals(true, $billet->getStatus());
    }

    public function testSetStatusFalse()
    {
        $billet = new Billet();
        $billet->setStatus(false);

        $this->assertEquals(false, $billet->getStatus());
    }

    public function testSeTarifReduitTrue()
    {
        $billet = new Billet();
        $billet->setTarifReduit(true);

        $this->assertEquals(true, $billet->getTarifReduit());
    }

    public function testSeTarifReduitFalse()
    {
        $billet = new Billet();
        $billet->setTarifReduit(false);

        $this->assertEquals(false, $billet->getTarifReduit());
    }


    public function testSetPrix()
    {
        $billet = new Billet();
        $billet->setPrix(16);

        $this->assertEquals(16, $billet->getPrix());
    }

    public function testSetTarif()
    {
        $billet = new Billet();
        $billet->setTarif('TARIF_NORMAL::');

        $this->assertEquals('TARIF_NORMAL::', $billet->getTarif());
    }

}