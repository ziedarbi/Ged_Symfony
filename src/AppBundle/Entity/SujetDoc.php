<?php
 
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Production
 *
 * @ORM\Table(name="sujetdoc")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DocRepository")
 */
class SujetDoc
{



    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=100)
     */
    private $titre;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrejournotif", type="integer", length=5)
     */
    private $nbrejournotif;

    /**
     * @return int
     */
    public function getNbrejournotif()
    {
        return $this->nbrejournotif;
    }

    /**
     * @param int $nbrejournotif
     */
    public function setNbrejournotif($nbrejournotif)
    {
        $this->nbrejournotif = $nbrejournotif;
    }






    /**
     * @var string
     *
     * @ORM\Column(name="dossier", type="string", length=100, nullable=false)
     */
    private $dossier;

    /**
     * @var string
     *
     * @ORM\Column(name="roleutilisateur", type="string", length=40, nullable=false)
     */
    private $roleutilisateur;

    /**
     * @return string
     */
    public function getRoleutilisateur()
    {
        return $this->roleutilisateur;
    }

    /**
     * @param string $roleutilisateur
     */
    public function setRoleutilisateur($roleutilisateur)
    {
        $this->roleutilisateur = $roleutilisateur;
    }




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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * @param string $dossier
     */
    public function setDossier($dossier)
    {
        $this->dossier = $dossier;
    }






    /**
     * @return string
     */
    public function getPecheance()
    {
        return $this->pecheance;
    }

    /**
     * @param string $pecheance
     */
    public function setPecheance($pecheance)
    {
        $this->pecheance = $pecheance;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="pecheance", type="string", length=20, nullable=false)
     */
    private $pecheance;

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
     * One Product has Many Features.
     *  @ORM\OneToMany(targetEntity="AppBundle\Entity\Doc", mappedBy="typeDoc")
     */
    private $docs;

    /**
     * Remove docs
     *
     * @param \AppBundle\Entity\Doc $docs
     */
    public function removeDocs(\AppBundle\Entity\Doc $docs)
    {
        $this->docs->removeElement($docs);
    }

    /**
     * Add docs
     *
     * @param \AppBundle\Entity\Doc $docs
     *
     * @return SujetDoc
     */
    public function addIdRC(\AppBundle\Entity\Doc $docs)
    {
        $this->docs[] = $docs;

        return $this;
    }

    /**
     * Get docs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocs()
    {
        return $this->docs;
    }


    /**
     * @param mixed $docs
     */
    public function setDocs($docs)
    {
        $this->docs = $docs;
    }

    public function __construct() {
        $this->docs= new \Doctrine\Common\Collections\ArrayCollection();
        $this->nbrejournotif=0;
    }

    /**
     * Add doc
     *
     * @param \AppBundle\Entity\Doc $doc
     *
     * @return SujetDoc
     */
    public function addDoc(\AppBundle\Entity\Doc $doc)
    {
        $this->docs[] = $doc;

        return $this;
    }

    /**
     * Remove doc
     *
     * @param \AppBundle\Entity\Doc $doc
     */
    public function removeDoc(\AppBundle\Entity\Doc $doc)
    {
        $this->docs->removeElement($doc);
    }
}
