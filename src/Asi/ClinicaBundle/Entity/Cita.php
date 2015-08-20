<?php

namespace Asi\ClinicaBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Cita
 */
class Cita
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fecharealizacion;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var string
     */
    private $tipocita;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $inmunizacion;

    /**
     * @var \Asi\ClinicaBundle\Entity\Disponibilidad
     */
    private $idDisponibilidad;

    /**
     * @var \Asi\ClinicaBundle\Entity\Paciente
     */
    private $idpaciente;

    /**
     * @var \Asi\ClinicaBundle\Entity\Consulta
     */
    private $idconsulta;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inmunizacion = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fecharealizacion
     *
     * @param \DateTime $fecharealizacion
     * @return Cita
     */
    public function setFecharealizacion($fecharealizacion)
    {
        $this->fecharealizacion = $fecharealizacion;
    
        return $this;
    }

    /**
     * Get fecharealizacion
     *
     * @return \DateTime 
     */
    public function getFecharealizacion()
    {
        return $this->fecharealizacion;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Cita
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    
        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Cita
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set tipocita
     *
     * @param string $tipocita
     * @return Cita
     */
    public function setTipocita($tipocita)
    {
        $this->tipocita = $tipocita;
    
        return $this;
    }

    /**
     * Get tipocita
     *
     * @return string 
     */
    public function getTipocita()
    {
        return $this->tipocita;
    }

    /**
     * Add inmunizacion
     *
     * @param \Asi\ClinicaBundle\Entity\Inmunizacion $inmunizacion
     * @return Cita
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
     * Set idDisponibilidad
     *
     * @param \Asi\ClinicaBundle\Entity\Disponibilidad $idDisponibilidad
     * @return Cita
     */
    public function setIdDisponibilidad(\Asi\ClinicaBundle\Entity\Disponibilidad $idDisponibilidad = null)
    {
        $this->idDisponibilidad = $idDisponibilidad;
    
        return $this;
    }


     public function getIdDisponibilidad()
    {
        return $this->idDisponibilidad;
    }
    
    /**
     * Set idpaciente
     *
     * @param \Asi\ClinicaBundle\Entity\Paciente $idpaciente
     * @return Cita
     */
    public function setIdpaciente(\Asi\ClinicaBundle\Entity\Paciente $idpaciente = null)
    {
        $this->idpaciente = $idpaciente;
    
        return $this;
    }

    /**
     * Get idpaciente
     *
     * @return \Asi\ClinicaBundle\Entity\Paciente 
     */
    public function getIdpaciente()
    {
        return $this->idpaciente;
    }

    /**
     * Get consulta
     *
     * @return \Asi\ClinicaBundle\Entity\Consulta 
     */
    public function getIdconsulta()
    {
        return $this->idconsulta;
    }

    public function getNombreApellidoFechaHora(){
        return sprintf('%s - %s', $this->idpaciente->getNombreApellido(), $this->idDisponibilidad->getFechaHora());
    }


}
