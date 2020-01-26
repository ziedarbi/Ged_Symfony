<?php
 
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Production
 *
 * @ORM\Table(name="employe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmployeRepository")
 */
class Employe
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date", nullable=true)
     */
    private $date_naissance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_embauche", type="date", nullable=true)
     */
    private $date_embauche;



    /**
     * @var string
     *
     * @ORM\Column(name="direction", type="string", length=60, nullable=false)
     */
    private $direction;


    /**
     * @var string
     *
     * @ORM\Column(name="service", type="string", length=60, nullable=false)
     */
    private $service;


    /**
     * @var string
     *
     * @ORM\Column(name="emploioccupe", type="string", length=60, nullable=false)
     */
    private $emploioccupe;

    /**
     * @var string
     *
     * @ORM\Column(name="diplome", type="string", length=60, nullable=false)
     */
    private $diplome;

    /**
     * @return \DateTime
     */
    public function getDateEmbauche()
    {
        return $this->date_embauche;
    }

    /**
     * @param \DateTime $date_embauche
     */
    public function setDateEmbauche($date_embauche)
    {
        $this->date_embauche = $date_embauche;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param string $direction
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;
    }

    /**
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param string $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @return string
     */
    public function getEmploioccupe()
    {
        return $this->emploioccupe;
    }

    /**
     * @param string $emploioccupe
     */
    public function setEmploioccupe($emploioccupe)
    {
        $this->emploioccupe = $emploioccupe;
    }

    /**
     * @return string
     */
    public function getDiplome()
    {
        return $this->diplome;
    }

    /**
     * @param string $diplome
     */
    public function setDiplome($diplome)
    {
        $this->diplome = $diplome;
    }

    /**
     * @return string
     */
    public function getNaturecontrat()
    {
        return $this->naturecontrat;
    }

    /**
     * @param string $naturecontrat
     */
    public function setNaturecontrat($naturecontrat)
    {
        $this->naturecontrat = $naturecontrat;
    }

    /**
     * @return string
     */
    public function getAgence()
    {
        return $this->agence;
    }

    /**
     * @param string $agence
     */
    public function setAgence($agence)
    {
        $this->agence = $agence;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=40, nullable=false)
     */
    private $nom;


    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=40, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="string", length=60, nullable=false)
     */
    private $specialite;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=10, nullable=false)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="naturecontrat", type="string", length=10, nullable=false)
     */
    private $naturecontrat;

    /**
     * @var string
     *
     * @ORM\Column(name="agence", type="string", length=80, nullable=false)
     */
    private $agence;



    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string", length=8, nullable=false)
     */
    private $cin;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var \AppBundle\Entity\Doc
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Doc", mappedBy="idEmploye" )
     *
     */
    private $idDoc;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idDoc= new \Doctrine\Common\Collections\ArrayCollection();

        $this->date_naissance = new \Datetime();
        $this->date_embauche = new \Datetime();
    }


    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Employe
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->date_naissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Employe
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
     * @return Employe
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
     * Set specialite
     *
     * @param string $specialite
     *
     * @return Employe
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * Get specialite
     *
     * @return string
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Set matricule
     *
     * @param string $matricule
     *
     * @return Employe
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set cin
     *
     * @param string $cin
     *
     * @return Employe
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
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
     * Add idDoc
     *
     * @param \AppBundle\Entity\Doc $idDoc
     *
     * @return Employe
     */
    public function addIdDoc(\AppBundle\Entity\Doc $idDoc)
    {
        $this->idDoc[] = $idDoc;

        return $this;
    }

    /**
     * Remove idDoc
     *
     * @param \AppBundle\Entity\Doc $idDoc
     */
    public function removeIdDoc(\AppBundle\Entity\Doc $idDoc)
    {
        $this->idDoc->removeElement($idDoc);
    }

    /**
     * Get idDoc
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdDoc()
    {
        return $this->idDoc;
    }
}
