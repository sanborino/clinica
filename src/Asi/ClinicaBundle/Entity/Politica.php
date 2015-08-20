<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Politica
 */
class Politica
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
     * @var string
     */
    private $descripcion;

    /**
     * @var boolean
     */
    private $estadoactivacion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $clinicapolitica;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clinicapolitica = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Politica
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Politica
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set estadoactivacion
     *
     * @param boolean $estadoactivacion
     * @return Politica
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
     * Add clinicapolitica
     *
     * @param \Asi\ClinicaBundle\Entity\Clinicapolitica $clinicapolitica
     * @return Politica
     */
    public function addClinicapolitica(\Asi\ClinicaBundle\Entity\Clinicapolitica $clinicapolitica)
    {
        $this->clinicapolitica[] = $clinicapolitica;
    
        return $this;
    }

    /**
     * Remove clinicapolitica
     *
     * @param \Asi\ClinicaBundle\Entity\Clinicapolitica $clinicapolitica
     */
    public function removeClinicapolitica(\Asi\ClinicaBundle\Entity\Clinicapolitica $clinicapolitica)
    {
        $this->clinicapolitica->removeElement($clinicapolitica);
    }

    /**
     * Get clinicapolitica
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClinicapolitica()
    {
        return $this->clinicapolitica;
    }
    
}
