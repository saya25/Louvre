<?php

namespace tests\Routing;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoutingTest extends WebTestCase
{
    public function testShowHomelEn()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/louvre/accueil');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Official Ticket Museum of the Louvre")')->count()
        );
    }

    public function testShowContactEn()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/louvre/contact');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("General information")')->count()
        );
    }

    public function testShowLegalMentionsEn()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/louvre/mentionslegales');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("LEGAL MENTIONS OF THE SITE")')->count()
        );
    }

    public function testShowTicketingEn()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/louvre/billetterie');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Detail of the order")')->count()
        );
    }

    public function testShowOrderEn()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/louvre/commande');
        $client->followRedirects($this->testShowTicketingEn());

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Your personal information")')->count()
        );
    }

    public function testShowAccueil()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/louvre/accueil');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Billetterie officielle musée du Louvre")')->count()
        );
    }

    public function testShowContact()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/louvre/contact');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Informations générales")')->count()
        );
    }

    public function testShowMentionsLegales()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/louvre/mentionslegales');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("MENTIONS LÉGALES DU SITE")')->count()
        );
    }

    public function testShowBilletterie()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/louvre/billetterie');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Détail de la commande")')->count()
        );
    }

    public function testShowCommande()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/louvre/commande');
        $client->followRedirects($this->testShowBilletterie());

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Vos informations personnelles")')->count()
        );
    }
}