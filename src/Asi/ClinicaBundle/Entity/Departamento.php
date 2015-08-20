<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departamento
 */
class Departamento
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
    private $municipio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->municipio = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Departamento
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
     * Add municipio
     *
     * @param \Asi\ClinicaBundle\Entity\Municipio $municipio
     * @return Departamento
     */
    public function addMunicipio(\Asi\ClinicaBundle\Entity\Municipio $municipio)
    {
        $this->municipio[] = $municipio;
    
        return $this;
    }

    /**
     * Remove municipio
     *
     * @param \Asi\ClinicaBundle\Entity\Municipio $municipio
     */
    public function removeMunicipio(\Asi\ClinicaBundle\Entity\Municipio $municipio)
    {
        $this->municipio->removeElement($municipio);
    }

    /**
     * Get municipio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }
    
}
