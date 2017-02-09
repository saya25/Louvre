<?php

namespace tests\Price;

use saya25\LouvreBundle\Entity\Billet;
use saya25\LouvreBundle\Entity\Commande;
use saya25\LouvreBundle\Service\Price;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MixPriceTicketsTest extends KernelTestCase {

    /** @var Price */
    protected $price;

    protected function setUp(){

        self::bootKernel();
        $this->price = static::$kernel->getContainer()->get('app.price');
    }

    public function testBigOrder(){

        // 1 Billet journée au tarif gratuit
        $billet1 = new Billet();
        $billet1->setNom('Dupuis');
        $billet1->setPrenom('Laura');
        $billet1->setStatus(true);
        $billet1->setPays('France');
        $billet1->setTarifReduit(false);
        $date1 = \DateTime::createFromFormat('d/m/Y', '05/10/2016');
        $billet1->setDateNaissance($date1);

        // 1 Billet journée au tarif réduit
        $billet2 = new Billet();
        $billet2->setNom('Dupuis');
        $billet2->setPrenom('Emilie');
        $billet2->setStatus(true);
        $billet2->setPays('France');
        $billet2->setTarifReduit(true);
        $date2 = \DateTime::createFromFormat('d/m/Y', '05/10/1980');
        $billet2->setDateNaissance($date2);


        // 2 Billets journée au tarif enfant
        $billet3 = new Billet();
        $billet3->setNom('Dupuis');
        $billet3->setPrenom('Mathieu');
        $billet3->setStatus(true);
        $billet3->setPays('France');
        $billet3->setTarifReduit(false);
        $date3 = \DateTime::createFromFormat('d/m/Y', '08/10/2008');
        $billet3->setDateNaissance($date3);

        $billet4 = new Billet();
        $billet4->setNom('Karen');
        $billet4->setPrenom('Oshields');
        $billet4->setStatus(true);
        $billet4->setPays('France');
        $billet4->setTarifReduit(false);
        $date4 = \DateTime::createFromFormat('d/m/Y', '05/11/2011');
        $billet4->setDateNaissance($date4);

        // 2 Billets journée au tarif normal
        $billet5 = new Billet();
        $billet5->setNom('MICHELIN');
        $billet5->setPrenom('Clement');
        $billet5->setStatus(true);
        $billet5->setPays('France');
        $billet5->setTarifReduit(false);
        $date5= \DateTime::createFromFormat('d/m/Y', '05/10/1990');
        $billet5->setDateNaissance($date5);

        $billet6 = new Billet();
        $billet6->setNom('Bishop');
        $billet6->setPrenom('Michael');
        $billet6->setStatus(true);
        $billet6->setPays('France');
        $billet6->setTarifReduit(false);
        $date6= \DateTime::createFromFormat('d/m/Y', '18/03/1987');
        $billet6->setDateNaissance($date6);


        // 2 Billet journée au tarif sénior
        $billet7 = new Billet();
        $billet7->setNom('Riley');
        $billet7->setPrenom('Angela');
        $billet7->setStatus(true);
        $billet7->setPays('France');
        $billet7->setTarifReduit(false);
        $date7 = \DateTime::createFromFormat('d/m/Y', '23/04/1940');
        $billet7->setDateNaissance($date7);

        $billet8 = new Billet();
        $billet8->setNom('Gibbs');
        $billet8->setPrenom('Robert');
        $billet8->setStatus(true);
        $billet8->setPays('France');
        $billet8->setTarifReduit(false);
        $date8 = \DateTime::createFromFormat('d/m/Y', '05/07/1950');
        $billet8->setDateNaissance($date8);

        // 1 Billet demi-journée au tarif normal
        $billet9 = new Billet();
        $billet9->setNom('Leonard');
        $billet9->setPrenom('Davis');
        $billet9->setStatus(false);
        $billet9->setPays('France');
        $billet9->setTarifReduit(false);
        $date9 = \DateTime::createFromFormat('d/m/Y', '05/10/1990');
        $billet9->setDateNaissance($date9);

        $commande = new Commande();
        $commande->setDateEntree(\DateTime::createFromFormat('d/m/Y','22/02/2017'));
        $commande->setNom('MICHELIN');
        $commande->setPrenom('Clement');
        $commande->setEmail('saya25@live.fr');

        $commande->addBillet($billet1);
        $commande->addBillet($billet2);
        $commande->addBillet($billet3);
        $commande->addBillet($billet4);
        $commande->addBillet($billet5);
        $commande->addBillet($billet6);
        $commande->addBillet($billet7);
        $commande->addBillet($billet8);
        $commande->addBillet($billet9);

        $billet1->setCommande($commande);
        $billet2->setCommande($commande);
        $billet3->setCommande($commande);
        $billet4->setCommande($commande);
        $billet5->setCommande($commande);
        $billet6->setCommande($commande);
        $billet7->setCommande($commande);
        $billet8->setCommande($commande);
        $billet9->setCommande($commande);

        $this->price->tarifBillet($commande);

        $this->assertEquals(0, $billet1->getPrix());
        $this->assertEquals(10, $billet2->getPrix());
        $this->assertEquals(8, $billet3->getPrix());
        $this->assertEquals(8, $billet4->getPrix());
        $this->assertEquals(16, $billet5->getPrix());
        $this->assertEquals(16, $billet6->getPrix());
        $this->assertEquals(12, $billet7->getPrix());
        $this->assertEquals(12, $billet8->getPrix());
        $this->assertEquals(8, $billet9->getPrix());

        $this->assertEquals(90, $commande->getTotal());
    }
}