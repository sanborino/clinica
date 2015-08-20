<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipovacuna
 */
class Tipovacuna
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
     * @var boolean
     */
    private $estadoactivacion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $vacuna;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vacuna = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estadoactivacion = true;
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
     * @return Tipovacuna
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
     * Set estadoactivacion
     *
     * @param boolean $estadoactivacion
     * @return Tipovacuna
     */
    public function setEstadoactivacion($estadoactivacion)
    {
        $this->estadoactivacion = $estadoactivacion;
    
        return $this;
    }

    /**
     * Get estadoactivacion
     *
     * @return boolean 
     */
    public function getEstadoactivacion()
    {
        return $this->estadoactivacion;
    }

    public function getEstadoActivacionString()
    {
        if ($this->estadoactivacion==1) {
            return 'Si';
        } else {
            return 'No';
        }
    }

    /**
     * Add vacuna
     *
     * @param \Asi\ClinicaBundle\Entity\Vacuna $vacuna
     * @return Tipovacuna
     */
    public function addVacuna(\Asi\ClinicaBundle\Entity\Vacuna $vacuna)
    {
        $this->vacuna[] = $vacuna;
    
        return $this;
    }

    /**
     * Remove vacuna
     *
     * @param \Asi\ClinicaBundle\Entity\Vacuna $vacuna
     */
    public function removeVacuna(\Asi\ClinicaBundle\Entity\Vacuna $vacuna)
    {
        $this->vacuna->removeElement($vacuna);
    }

    /**
     * Get vacuna
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVacuna()
    {
        return $this->vacuna;
    }
   
}
