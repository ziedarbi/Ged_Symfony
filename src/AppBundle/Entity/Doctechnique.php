<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Production
 *
 * @ORM\Table(name="doctechnique")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DoctechniqueRepository")
 */
class Doctechnique
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="date", nullable=true)
     */
    private $date_ajout;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_validite", type="date", nullable=true)
     */
    private $date_validite;



    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=40, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=40, nullable=false)
     */
    private $etat;


    /**
     * @var string
     *
     * @ORM\Column(name="notifier", type="string", length=10, nullable=false)
     */
    private $notifier;


    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }







    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="string", length=40, nullable=false)
     */
    private $fichier;

    /**
     * @var \AppBundle\Entity\Employe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Employe", inversedBy="idDoc")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     *
     */
    private $idEmploye;


    /**
     * @var \AppBundle\Entity\SujetDoc
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SujetDoc", inversedBy="docs")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     *
     */
    private $typeDoc;




    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return string
     */
    public function getNotifier()
    {
        return $this->notifier;
    }

    /**
     * @param string $notifier
     */
    public function setNotifier($notifier)
    {
        $this->notifier = $notifier;
    }



    public function __construct()
    {
        $this->date_ajout = new \Datetime();
        $this->date_validite = new \Datetime();
        $this->notifier='Non';
    }


    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return Doc
     */
    public function setDateAjout($dateAjout)
    {
        $this->date_ajout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->date_ajout;
    }

    /**
     * Set dateValidite
     *
     * @param \DateTime $dateValidite
     *
     * @return Doc
     */
    public function setDateValidite($dateValidite)
    {
        $this->date_validite = $dateValidite;

        return $this;
    }

    /**
     * Get dateValidite
     *
     * @return \DateTime
     */
    public function getDateValidite()
    {
        return $this->date_validite;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Doc
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
     * Set fichier
     *
     * @param string $fichier
     *
     * @return Doc
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier
     *
     * @return string
     */
    public function getFichier()
    {
        return $this->fichier;
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
     * Set idEmploye
     *
     * @param \AppBundle\Entity\Employe $idEmploye
     *
     * @return Doc
     */
    public function setIdEmploye(\AppBundle\Entity\Employe $idEmploye = null)
    {
        $this->idEmploye = $idEmploye;

        return $this;
    }

    /**
     * Get idEmploye
     *
     * @return \AppBundle\Entity\Employe
     */
    public function getIdEmploye()
    {
        return $this->idEmploye;
    }



    /**
     * Get typeDoc
     * @return \AppBundle\Entity\SujetDoc
     */
    public function getTypeDoc()
    {
        return $this->typeDoc;
    }

    /**Set typeDoc
     * @param \AppBundle\Entity\SujetDoc $typeDoc
     * @return Doc
     */
    public function setTypeDoc(\AppBundle\Entity\SujetDoc $typeDoc= null)
    {
        $this->typeDoc = $typeDoc;
        return $this;
    }

    /**
     * @var \AppBundle\Entity\NiveauGrade
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Procede", inversedBy="listedoctech")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     *  @Assert\NotBlank()
     *
     */
    private $idprocede;







    /**
     * Set idprocede
     *
     * @param \AppBundle\Entity\Procede $idprocede
     *
     * @return Doctechnique
     */
    public function setIdprocede(\AppBundle\Entity\Procede $idprocede = null)
    {
        $this->idprocede = $idprocede;

        return $this;
    }

    /**
     * Get idprocede
     *
     * @return \AppBundle\Entity\Procede
     */
    public function getIdprocede()
    {
        return $this->idprocede;
    }
}
