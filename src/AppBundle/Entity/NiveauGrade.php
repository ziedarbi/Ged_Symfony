<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Production
 *
 * @ORM\Table(name="niveaugrade")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NiveauGradeRepository")
 */
class NiveauGrade
{

    /**
     * @var string
     *
     * @ORM\Column(name="nomniveaugrade", type="string", length=40, nullable=false)
     */
    private $nomniveaugrade;



    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;











    /**
     * Get idRC
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListedoctech()
    {
        return $this->listedoctech;
    }





    /**
     * Set nomniveaugrade
     *
     * @param string $nomniveaugrade
     *
     * @return NiveauGrade
     */
    public function setNomniveaugrade($nomniveaugrade)
    {
        $this->nomniveaugrade = $nomniveaugrade;

        return $this;
    }

    /**
     * Get nomniveaugrade
     *
     * @return string
     */
    public function getNomniveaugrade()
    {
        return $this->nomniveaugrade;
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

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->nomniveaugrade;
    }
}
