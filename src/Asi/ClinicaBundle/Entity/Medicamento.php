<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medicamento
 */
class Medicamento
{
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
     * @var \Asi\ClinicaBundle\Entity\Tipomedicamento
     */
    private $idtipomedicamento;

    public function __construct()
    {
        $this->estadoactivacion = true;
    }


    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Medicamento
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
     * @return Medicamento
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
     * @return Medicamento
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
     * Set idtipomedicamento
     *
     * @param \Asi\ClinicaBundle\Entity\Tipomedicamento $idtipomedicamento
     * @return Medicamento
     */
    public function setIdtipomedicamento(\Asi\ClinicaBundle\Entity\Tipomedicamento $idtipomedicamento = null)
    {
        $this->idtipomedicamento = $idtipomedicamento;
    
        return $this;
    }

    /**
     * Get idtipomedicamento
     *
     * @return \Asi\ClinicaBundle\Entity\Tipomedicamento 
     */
    public function getIdtipomedicamento()
    {
        return $this->idtipomedicamento;
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
