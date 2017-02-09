<?php

namespace tests\Price;

use saya25\LouvreBundle\Entity\Billet;
use saya25\LouvreBundle\Entity\Commande;
use saya25\LouvreBundle\Service\Price;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PriceTypeTicketsAndTotalOrderWithStatusDayTest extends KernelTestCase {

    /** @var Price */
    protected $price;

    protected function setUp(){

        self::bootKernel();
        $this->price = static::$kernel->getContainer()->get('app.price');
    }

    public function testPriceFree(){

        $billet = new Billet();
        $billet->setNom('MICHELIN');
        $billet->setPrenom('Clement');
        $billet->setStatus(true);
        $billet->setPays('France');
        $billet->setTarifReduit(false);
        $date = \DateTime::createFromFormat('d/m/Y', '05/12/2015');
        $billet->setDateNaissance($date);

        $commande = new Commande();
        $commande->setDateEntree(\DateTime::createFromFormat('d/m/Y','22/02/2017'));
        $commande->setNom('MICHELIN');
        $commande->setPrenom('Clement');
        $commande->setEmail('saya25@live.fr');


        $commande->addBillet($billet);
        $billet->setCommande($commande);

        $this->price->tarifBillet($commande);

        $this->assertEquals(0, $commande->getTotal());
        $this->assertEquals(0, $billet->getPrix());
    }

    public function testPriceReduced(){

        $billet = new Billet();
        $billet->setNom('MICHELIN');
        $billet->setPrenom('Clement');
        $billet->setStatus(true);
        $billet->setPays('France');
        $billet->setTarifReduit(true);
        $date = \DateTime::createFromFormat('d/m/Y', '05/10/1990');
        $billet->setDateNaissance($date);

        $commande = new Commande();
        $commande->setDateEntree(\DateTime::createFromFormat('d/m/Y','22/02/2017'));
        $commande->setNom('MICHELIN');
        $commande->setPrenom('Clement');
        $commande->setEmail('saya25@live.fr');


        $commande->addBillet($billet);
        $billet->setCommande($commande);

        $this->price->tarifBillet($commande);

        $this->assertEquals(10, $commande->getTotal());
        $this->assertEquals(10, $billet->getPrix());
    }

    public function testPriceChild(){

        $billet = new Billet();
        $billet->setNom('MICHELIN');
        $billet->setPrenom('Clement');
        $billet->setStatus(true);
        $billet->setPays('France');
        $billet->setTarifReduit(false);
        $date = \DateTime::createFromFormat('d/m/Y', '05/12/2008');
        $billet->setDateNaissance($date);

        $commande = new Commande();
        $commande->setDateEntree(\DateTime::createFromFormat('d/m/Y','22/02/2017'));
        $commande->setNom('MICHELIN');
        $commande->setPrenom('Clement');
        $commande->setEmail('saya25@live.fr');


        $commande->addBillet($billet);
        $billet->setCommande($commande);

        $this->price->tarifBillet($commande);

        $this->assertEquals(8, $commande->getTotal());
        $this->assertEquals(8, $billet->getPrix());
    }

    public function testPriceNormal(){

        $billet = new Billet();
        $billet->setNom('MICHELIN');
        $billet->setPrenom('Clement');
        $billet->setStatus(true);
        $billet->setPays('France');
        $billet->setTarifReduit(false);
        $date = \DateTime::createFromFormat('d/m/Y', '05/10/1990');
        $billet->setDateNaissance($date);

        $commande = new Commande();
        $commande->setDateEntree(\DateTime::createFromFormat('d/m/Y','22/02/2017'));
        $commande->setNom('MICHELIN');
        $commande->setPrenom('Clement');
        $commande->setEmail('saya25@live.fr');


        $commande->addBillet($billet);
        $billet->setCommande($commande);

        $this->price->tarifBillet($commande);

        $this->assertEquals(16, $commande->getTotal());
        $this->assertEquals(16, $billet->getPrix());
    }

    public function testPriceSenior(){

        $billet = new Billet();
        $billet->setNom('MICHELIN');
        $billet->setPrenom('Clement');
        $billet->setStatus(true);
        $billet->setPays('France');
        $billet->setTarifReduit(false);
        $date = \DateTime::createFromFormat('d/m/Y', '05/10/1950');
        $billet->setDateNaissance($date);

        $commande = new Commande();
        $commande->setDateEntree(\DateTime::createFromFormat('d/m/Y','22/02/2017'));
        $commande->setNom('MICHELIN');
        $commande->setPrenom('Clement');
        $commande->setEmail('saya25@live.fr');


        $commande->addBillet($billet);
        $billet->setCommande($commande);

        $this->price->tarifBillet($commande);

        $this->assertEquals(12, $commande->getTotal());
        $this->assertEquals(12, $billet->getPrix());
    }



}