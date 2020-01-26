<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Production
 *
 * @ORM\Table(name="procede")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProcedeRepository")
 */
class Procede
{



    /**
     * @var string
     *
     * @ORM\Column(name="nomprocede", type="string", length=40, nullable=false)
     */
    private $nomprocede;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\MethodeDispline
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MethodeDispline", inversedBy="procedes")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     *
     */
    private $idmethodedisp;

    /**
     * Set idmethodedisp
     *
     * @param integer $idmethodedisp
     *
     * @return Procede
     */
    public function setIdmethodedisp($idmethodedisp)
    {
        $this->idmethodedisp = $idmethodedisp;

        return $this;
    }

    /**
     * Get idmethodedisp
     *
     * @return int
     */
    public function getIdmethodedisp()
    {
        return $this->idmethodedisp;
    }





    /**
     * @var \AppBundle\Entity\Doctechnique
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Doctechnique", mappedBy="idprocede")
     *
     */
    private $listedoctech;





    /**
     * Set nomprocede
     *
     * @param string $nomprocede
     *
     * @return Procede
     */
    public function setNomprocede($nomprocede)
    {
        $this->nomprocede = $nomprocede;

        return $this;
    }

    /**
     * Get nomprocede
     *
     * @return string
     */
    public function getNomprocede()
    {
        return $this->nomprocede;
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
     * Add niveaugrad
     *
     * @param \AppBundle\Entity\NiveauGrade $niveaugrad
     *
     * @return Procede
     */
    public function addNiveaugrad(\AppBundle\Entity\NiveauGrade $niveaugrad)
    {
        $this->niveaugrads[] = $niveaugrad;

        return $this;
    }

    /**
     * Remove niveaugrad
     *
     * @param \AppBundle\Entity\NiveauGrade $niveaugrad
     */
    public function removeNiveaugrad(\AppBundle\Entity\NiveauGrade $niveaugrad)
    {
        $this->niveaugrads->removeElement($niveaugrad);
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->nomprocede;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->listedoctech = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add listedoctech
     *
     * @param \AppBundle\Entity\Doctechnique $listedoctech
     *
     * @return Procede
     */
    public function addListedoctech(\AppBundle\Entity\Doctechnique $listedoctech)
    {
        $this->listedoctech[] = $listedoctech;

        return $this;
    }

    /**
     * Remove listedoctech
     *
     * @param \AppBundle\Entity\Doctechnique $listedoctech
     */
    public function removeListedoctech(\AppBundle\Entity\Doctechnique $listedoctech)
    {
        $this->listedoctech->removeElement($listedoctech);
    }

    /**
     * Get listedoctech
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListedoctech()
    {
        return $this->listedoctech;
    }
}
