<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Production
 *
 * @ORM\Table(name="familleinsp")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FamilleInspRepository")
 */
class FamilleInsp
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
     * @ORM\Column(name="nomfamille", type="string", length=20, nullable=false)
     */
    private $nomfamille;

    /**
     * @var \AppBundle\Entity\MethodeDispline
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MethodeDispline", mappedBy="idfamilleInsp")
     *
     */
    private $idMethodeDisp;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idMethodeDisp = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add idMethodeDisp
     *
     * @param \AppBundle\Entity\MethodeDispline $idMethodeDisp
     *
     * @return FamilleInsp
     */
    public function addIdMethodeDisp(\AppBundle\Entity\MethodeDispline $idMethodeDisp)
    {
        $this->idMethodeDisp[] = $idMethodeDisp;

        return $this;
    }

    /**
     * Remove idMethodeDisp
     *
     * @param \AppBundle\Entity\MethodeDispline $idMethodeDisp
     */
    public function removeIdMethodeDisp(\AppBundle\Entity\MethodeDispline $idMethodeDisp)
    {
        $this->idMethodeDisp->removeElement($idMethodeDisp);
    }

    /**
     * Get idMethodeDisp
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdMethodeDisp()
    {
        return $this->idMethodeDisp;
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
     * Set nomfamille
     *
     * @param string $nomfamille
     *
     * @return FamilleInsp
     */
    public function setNomfamille($nomfamille)
    {
        $this->nomfamille = $nomfamille;

        return $this;
    }

    /**
     * Get nomfamille
     *
     * @return string
     */
    public function getNomfamille()
    {
        return $this->nomfamille;
    }

public function __toString()
{
    // TODO: Implement __toString() method.
    return $this->nomfamille;
}
}
