<?php

namespace saya25\LouvreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Billet
 *
 * @ORM\Table(name="billet")
 * @ORM\Entity(repositoryClass="saya25\LouvreBundle\Repository\BilletRepository")
 */
class Billet
{

    CONST TARIF_GRAUTIT ='gratuit';
    CONST TARIF_ENFANT = 'enfant';
    CONST TARIF_NORMAL = 'normal';
    CONST TARIF_SENIOR = 'sénior';
    CONST TARIF_REDUIT = 'réduit';

    CONST BILLET_GRATUIT = 0;
    CONST BILLET_ENFANT = 8;
    CONST BILLET_NORMAL = 16;
    CONST BILLET_SENIOR = 12;
    CONST BILLET_REDUIT = 10;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=150, nullable=false)
     * @Assert\Length(min=3, minMessage="Le nom saisi n'est pas valide")
     * @Assert\Length(max=25, maxMessage="Le nom saisi n'est pas valide")
     */
    private $nom;


    /**
     * @var string
     *
     * @ORM\Column(name="Pays", type="string", length=255)
     */
    private $pays;



    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=150, nullable=false)
     * @Assert\Length(min=3, minMessage="Le prénom saisi est trop court")
     * @Assert\Length(max=20, maxMessage="Le prenom saisi n'est pas valide")
     */
    private $prenom;


    /**
     * @var date
     *
     * @ORM\Column(name="dateNaissance", type="date", nullable=false)
     */
    private $dateNaissance;


    /**
     * @var boolean
     *
     * @ORM\Column(name="tarifReduit", type="boolean", nullable=false)
     */
    private $tarifReduit;



    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;


    /**
     * @var string
     *
     * @ORM\Column(name="Tarif", type="string", length=255)
     */
    private $tarif;






     /**
     * @ORM\ManyToOne(targetEntity="saya25\LouvreBundle\Entity\Commande", inversedBy="billet", cascade={"persist", "remove"})
     */
    private $commande;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Billet
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Billet
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Billet
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set tarifReduit
     *
     * @param boolean $tarifReduit
     *
     * @return Billet
     */
    public function setTarifReduit($tarifReduit)
    {
        $this->tarifReduit = $tarifReduit;

        return $this;
    }

    /**
     * Get tarifReduit
     *
     * @return boolean
     */
    public function getTarifReduit()
    {
        return $this->tarifReduit;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Billet
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set commande
     *
     * @param \saya25\LouvreBundle\Entity\Commande $commande
     *
     * @return Billet
     */
    public function setCommande(\saya25\LouvreBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \saya25\LouvreBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Billet
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Billet
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }



    /**
     * Set tarif
     *
     * @param string $tarif
     *
     * @return Billet
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return string
     */
    public function getTarif()
    {
        return $this->tarif;
    }
}
