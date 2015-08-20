<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disponibilidad
 */
class Disponibilidad
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $hora;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var boolean
     */
    private $disponibilidad;

    /**
     * @var \Asi\ClinicaBundle\Entity\Clinica
     */
    private $idclinica;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $citas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->citas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set hora
     *
     * @param \DateTime $hora
     * @return Disponibilidad
     */
    public function setHora($hora)

    {
        $this->hora = $hora;
    
        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime 
     */
    public function getHora()
    {
        
        return $this->hora;
    }

    
    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Disponibilidad
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set disponibilidad
     *
     * @param boolean $disponibilidad
     * @return Disponibilidad
     */
    public function setDisponibilidad($disponibilidad)
    {
        $this->disponibilidad = $disponibilidad;
    
        return $this;
    }
    
    /**
     * Get disponibilidad
     *
     * @return boolean 
     */
    public function getDisponibilidad()
    {
        return $this->disponibilidad;
    }

    public function getDisponibilidadString()
    {
        if ($this->disponibilidad==1) {
            return 'Disponible';
        } else {
            return 'No disponible';
        }
    }


    /**
     * Get citas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCitas()
    {
        return $this->citas;
    }

    /**
     * Set idclinica
     *
     * @param \Asi\ClinicaBundle\Entity\Clinica $idclinica
     * @return Disponibilidad
     */
    public function setIdclinica(\Asi\ClinicaBundle\Entity\Clinica $idclinica = null)
    {
        $this->idclinica = $idclinica;
    
        return $this;
    }

    /**
     * Get idclinica
     *
     * @return \Asi\ClinicaBundle\Entity\Clinica 
     */
    public function getIdclinica()
    {
        return $this->idclinica;
    }


    public function getFechaHora(){

        return $this->fecha->format("Y-m-d") . " - " . $this->hora->format("H:i");
    }

    public function getFechaHoraConsultorio(){

        return $this->fecha->format("Y-m-d") . " - " . $this->hora->format("H:i"). " " .$this->getIdclinica()->getNombre();
    }

}
