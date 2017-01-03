<?php

namespace saya25\LouvreBundle\Service;

use saya25\LouvreBundle\Entity\Billet;
use saya25\LouvreBundle\Entity\Commande;


class Price
{

    private $prixCommande;

    public function tarifBillet(Commande $commande)
    {
        $billet = $commande->getBillet();
        foreach($billet as $blt) {

            $datenaissance = $blt->getdateNaissance();

            $dateInterval = $datenaissance->diff(new\DateTime());

            if ($dateInterval->y < 4) {
                $blt->setTarif(BILLET::TARIF_GRAUTIT);
                $blt->setPrix(BILLET::BILLET_GRATUIT);
            } else if ($dateInterval->y < 12) {
                $blt->setTarif(BILLET::TARIF_ENFANT);
                $blt->setPrix(BILLET::BILLET_ENFANT);
            } else if ($dateInterval->y > 60) {
                $blt->setTarif(BILLET::TARIF_SENIOR);
                $blt->setPrix(BILLET::BILLET_SENIOR);
                if ($blt->getTarifReduit()) {
                    $blt->setTarif(BILLET::TARIF_REDUIT);
                    $blt->setPrix(BILLET::BILLET_REDUIT);
                }
            } else {
                $blt->setTarif(BILLET::TARIF_NORMAL);
                $blt->setPrix(BILLET::BILLET_NORMAL);
                if ($blt->getTarifReduit() === true) {
                    $blt->setTarif(BILLET::TARIF_REDUIT);
                    $blt->setPrix(BILLET::BILLET_REDUIT);
                }
            }

            // Tarif si demi-journée divisé par 2
            if ($blt->getStatus() === 'demi-journée') {
                $blt->setPrix($blt->getPrix() / 2);
            }

            $this->prixCommande += $blt->getPrix();
            $commande->setTotal($this->prixCommande);
        }

    }
}








