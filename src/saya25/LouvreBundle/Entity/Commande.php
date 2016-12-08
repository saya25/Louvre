<?php

namespace saya25\LouvreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="saya25\LouvreBundle\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;



    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCommande", type="datetime")
     */
    private $dateCommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEntree", type="datetime")
     */
    private $dateEntree;


    /**
     * @var string
     *
     * @ORM\Column(name="numeroReservation", type="string", length=255)
     */
    private $numeroReservation;


    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;



    /**
     * @ORM\OneToMany(targetEntity="saya25\LouvreBundle\Entity\Billet", mappedBy="commande", cascade={"persist"})
     */
    private $billet;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->billet = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Commande
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
     * @return Commande
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
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     *
     * @return Commande
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set dateEntree
     *
     * @param \DateTime $dateEntree
     *
     * @return Commande
     */
    public function setDateEntree($dateEntree)
    {
        $this->dateEntree = $dateEntree;

        return $this;
    }

    /**
     * Get dateEntree
     *
     * @return \DateTime
     */
    public function getDateEntree()
    {
        return $this->dateEntree;
    }

    /**
     * Set numeroReservation
     *
     * @param string $numeroReservation
     *
     * @return Commande
     */
    public function setNumeroReservation($numeroReservation)
    {
        $this->numeroReservation = $numeroReservation;

        return $this;
    }

    /**
     * Get numeroReservation
     *
     * @return string
     */
    public function getNumeroReservation()
    {
        return $this->numeroReservation;
    }


    /**
     * Add billet
     *
     * @param \saya25\LouvreBundle\Entity\Billet $billet
     *
     * @return Commande
     */
    public function addBillet(\saya25\LouvreBundle\Entity\Billet $billet)
    {
        $this->billet[] = $billet;

        return $this;
    }

    /**
     * Remove billet
     *
     * @param \saya25\LouvreBundle\Entity\Billet $billet
     */
    public function removeBillet(\saya25\LouvreBundle\Entity\Billet $billet)
    {
        $this->billet->removeElement($billet);
    }

    /**
     * Get billet
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBillet()
    {
        return $this->billet;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return Commande
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Commande
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
