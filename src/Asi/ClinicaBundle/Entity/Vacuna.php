<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vacuna
 */
class Vacuna
{

    /**
     * @var integer
     */
    private $cantidaddosis;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var boolean
     */
    private $estadoactivacion;

    /**
     * @var \Asi\ClinicaBundle\Entity\Servicio
     */
    private $idservicio;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $inmunizacion;

    /**
     * @var \Asi\ClinicaBundle\Entity\Tipovacuna
     */
    private $idtipovacuna;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inmunizacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estadoactivacion = true;
    }

    /**
     * Set cantidaddosis
     *
     * @param integer $cantidaddosis
     * @return Vacuna
     */
    public function setCantidaddosis($cantidaddosis)
    {
        $this->cantidaddosis = $cantidaddosis;
    
        return $this;
    }

    /**
     * Get cantidaddosis
     *
     * @return integer 
     */
    public function getCantidaddosis()
    {
        return $this->cantidaddosis;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Vacuna
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
     * @return Vacuna
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
     * Set idservicio
     *
     * @param \Asi\ClinicaBundle\Entity\Servicio $idservicio
     * @return Vacuna
     */
    public function setIdservicio(\Asi\ClinicaBundle\Entity\Servicio $idservicio = null)
    {
        $this->idservicio = $idservicio;
    
        return $this;
    }

    /**
     * Get idservicio
     *
     * @return \Asi\ClinicaBundle\Entity\Servicio 
     */
    public function getIdservicio()
    {
        return $this->idservicio;
    }

    /**
     * Add inmunizacion
     *
     * @param \Asi\ClinicaBundle\Entity\Inmunizacion $inmunizacion
     * @return Vacuna
     */
    public function addInmunizacion(\Asi\ClinicaBundle\Entity\Inmunizacion $inmunizacion)
    {
        $this->inmunizacion[] = $inmunizacion;
    
        return $this;
    }

    /**
     * Remove inmunizacion
     *
     * @param \Asi\ClinicaBundle\Entity\Inmunizacion $inmunizacion
     */
    public function removeInmunizacion(\Asi\ClinicaBundle\Entity\Inmunizacion $inmunizacion)
    {
        $this->inmunizacion->removeElement($inmunizacion);
    }

    /**
     * Get inmunizacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInmunizacion()
    {
        return $this->inmunizacion;
    }

    /**
     * Set idtipovacuna
     *
     * @param \Asi\ClinicaBundle\Entity\Tipovacuna $idtipovacuna
     * @return Vacuna
     */
    public function setIdtipovacuna(\Asi\ClinicaBundle\Entity\Tipovacuna $idtipovacuna = null)
    {
        $this->idtipovacuna = $idtipovacuna;
    
        return $this;
    }

    /**
     * Get idtipovacuna
     *
     * @return \Asi\ClinicaBundle\Entity\Tipovacuna 
     */
    public function getIdtipovacuna()
    {
        return $this->idtipovacuna;
    }

    /**
     * @var integer
     */
    private $id;


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
     * Get id
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->idservicio->getNombre();
    }

}
