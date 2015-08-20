<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Especialidad
 */
class Especialidad
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
    private $abreviatura;

    /**
     * @var boolean
     */
    private $estadoactivacion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $itemespecialidad;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->itemespecialidad = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Especialidad
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
     * Set abreviatura
     *
     * @param string $abreviatura
     * @return Especialidad
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;
    
        return $this;
    }

    /**
     * Get abreviatura
     *
     * @return string 
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * Set estadoactivacion
     *
     * @param boolean $estadoactivacion
     * @return Especialidad
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
     * Add itemespecialidad
     *
     * @param \Asi\ClinicaBundle\Entity\Itemespecialidad $itemespecialidad
     * @return Especialidad
     */
    public function addItemespecialidad(\Asi\ClinicaBundle\Entity\Itemespecialidad $itemespecialidad)
    {
        $this->itemespecialidad[] = $itemespecialidad;
    
        return $this;
    }

    /**
     * Remove itemespecialidad
     *
     * @param \Asi\ClinicaBundle\Entity\Itemespecialidad $itemespecialidad
     */
    public function removeItemespecialidad(\Asi\ClinicaBundle\Entity\Itemespecialidad $itemespecialidad)
    {
        $this->itemespecialidad->removeElement($itemespecialidad);
    }

    /**
     * Get itemespecialidad
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItemespecialidad()
    {
        return $this->itemespecialidad;
    }
    
}
