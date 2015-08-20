<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Examen
 */
class Examen
{
    /**
     * @var boolean
     */
    private $estadoactivacion;

    /**
     * @var \Asi\ClinicaBundle\Entity\Servicio
     */
    private $idservicio;

    /**
     * @var \Asi\ClinicaBundle\Entity\Tipoexamen
     */
    private $idtipoexamen;

    public function __construct()
    {
        $this->estadoactivacion = true;
    }


    /**
     * Set estadoactivacion
     *
     * @param boolean $estadoactivacion
     * @return Examen
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
     * @return Examen
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
     * Set idtipoexamen
     *
     * @param \Asi\ClinicaBundle\Entity\Tipoexamen $idtipoexamen
     * @return Examen
     */
    public function setIdtipoexamen(\Asi\ClinicaBundle\Entity\Tipoexamen $idtipoexamen = null)
    {
        $this->idtipoexamen = $idtipoexamen;
    
        return $this;
    }

    /**
     * Get idtipoexamen
     *
     * @return \Asi\ClinicaBundle\Entity\Tipoexamen 
     */
    public function getIdtipoexamen()
    {
        return $this->idtipoexamen;
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
}
