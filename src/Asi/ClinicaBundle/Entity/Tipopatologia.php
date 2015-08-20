<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipopatologia
 */
class Tipopatologia
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $patologia;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->patologia = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Tipopatologia
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add patologia
     *
     * @param \Asi\ClinicaBundle\Entity\Patologia $patologia
     * @return Tipopatologia
     */
    public function addPatologium(\Asi\ClinicaBundle\Entity\Patologia $patologia)
    {
        $this->patologia[] = $patologia;
    
        return $this;
    }

    /**
     * Remove patologia
     *
     * @param \Asi\ClinicaBundle\Entity\Patologia $patologia
     */
    public function removePatologium(\Asi\ClinicaBundle\Entity\Patologia $patologia)
    {
        $this->patologia->removeElement($patologia);
    }

    /**
     * Get patologia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPatologia()
    {
        return $this->patologia;
    }
    
}
