<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Production
 *
 * @ORM\Table(name="methodedispline")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MethodeDisplineRepository")
 */
class MethodeDispline
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
     * @ORM\Column(name="nom", type="string", length=40, nullable=false)
     */
    private $nom;

    /**
     * @var \AppBundle\Entity\FamilleInsp
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FamilleInsp", inversedBy="idMethodeDisp")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     *
     */
    private $idfamilleInsp;

    /**
     * Set idfamilleInsp
     *
     * @param integer $idfamilleInsp
     *
     * @return MethodeDispline
     */
    public function setIdfamilleInsp($idfamilleInsp)
    {
        $this->idfamilleInsp = $idfamilleInsp;

        return $this;
    }

    /**
     * Get idfamilleInsp
     *
     * @return int
     */
    public function getIdfamilleInsp()
    {
        return $this->idfamilleInsp;
    }

    /**
     * @var \AppBundle\Entity\Procede
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Procede", mappedBy="idmethodedisp")
     *
     */
    private $procedes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->procedes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add procedes
     *
     * @param \AppBundle\Entity\Procede $procedes
     *
     * @return MethodeDispline
     */
    public function addProcedes(\AppBundle\Entity\Procede $procedes)
    {
        $this->procedes[] = $procedes;

        return $this;
    }

    /**
     * Remove procedes
     *
     * @param \AppBundle\Entity\Procede $procedes
     */
    public function removeProcedes(\AppBundle\Entity\Procede $procedes)
    {
        $this->procedes->removeElement($procedes);
    }

    /**
     * Get procedes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProcedes()
    {
        return $this->procedes;
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
     * @return MethodeDispline
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
     * Add procede
     *
     * @param \AppBundle\Entity\Procede $procede
     *
     * @return MethodeDispline
     */
    public function addProcede(\AppBundle\Entity\Procede $procede)
    {
        $this->procedes[] = $procede;

        return $this;
    }

    /**
     * Remove procede
     *
     * @param \AppBundle\Entity\Procede $procede
     */
    public function removeProcede(\AppBundle\Entity\Procede $procede)
    {
        $this->procedes->removeElement($procede);
    }
    public function  __toString()
    {
        // TODO: Implement __toString() method.
        return $this->nom;
    }
}
