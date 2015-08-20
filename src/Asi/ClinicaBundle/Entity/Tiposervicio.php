<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tiposervicio
 */
class Tiposervicio
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
    private $servicio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->servicio = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Tiposervicio
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
     * @return Tiposervicio
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
     * Add servicio
     *
     * @param \Asi\ClinicaBundle\Entity\Servicio $servicio
     * @return Tiposervicio
     */
    public function addServicio(\Asi\ClinicaBundle\Entity\Servicio $servicio)
    {
        $this->servicio[] = $servicio;
    
        return $this;
    }

    /**
     * Remove servicio
     *
     * @param \Asi\ClinicaBundle\Entity\Servicio $servicio
     */
    public function removeServicio(\Asi\ClinicaBundle\Entity\Servicio $servicio)
    {
        $this->servicio->removeElement($servicio);
    }

    /**
     * Get servicio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServicio()
    {
        return $this->servicio;
    }
}
