<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clinica
 */
class Clinica
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
    private $direccion;

    /**
     * @var string
     */
    private $telefono;

    /**
     * @var \DateTime
     */
    private $citahorapromedio;

    /**
     * @var \DateTime
     */
    private $horaaperturasemana;

    /**
     * @var \DateTime
     */
    private $horacierresemana;

    /**
     * @var \DateTime
     */
    private $horaaperturasabado;

    /**
     * @var \DateTime
     */
    private $horacierresabado;

    /**
     * @var \DateTime
     */
    private $horaaperturadomingo;

    /**
     * @var \DateTime
     */
    private $horacierredomingo;

    /**
     * @var integer
     */
    private $anticipacioncita;

    /**
     * @var boolean
     */
    private $estadoactivacion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $disponibilidad;

    /**
     * @var \Asi\ClinicaBundle\Entity\Municipio
     */
    private $idmunicipio;

    /**
     * @var \Asi\ClinicaBundle\Entity\Especialidad
     */
    private $idespecialidad;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->disponibilidad = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Clinica
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
     * Set direccion
     *
     * @param string $direccion
     * @return Clinica
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Clinica
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set citahorapromedio
     *
     * @param \DateTime $citahorapromedio
     * @return Clinica
     */
    public function setCitahorapromedio($citahorapromedio)
    {
        $this->citahorapromedio = $citahorapromedio;
    
        return $this;
    }

    /**
     * Get citahorapromedio
     *
     * @return \DateTime 
     */
    public function getCitahorapromedio()
    {
        return $this->citahorapromedio;
    }

    /**
     * Set horaaperturasemana
     *
     * @param \DateTime $horaaperturasemana
     * @return Clinica
     */
    public function setHoraaperturasemana($horaaperturasemana)
    {
        $this->horaaperturasemana = $horaaperturasemana;
    
        return $this;
    }

    /**
     * Get horaaperturasemana
     *
     * @return \DateTime 
     */
    public function getHoraaperturasemana()
    {
        return $this->horaaperturasemana;
    }

    /**
     * Set horacierresemana
     *
     * @param \DateTime $horacierresemana
     * @return Clinica
     */
    public function setHoracierresemana($horacierresemana)
    {
        $this->horacierresemana = $horacierresemana;
    
        return $this;
    }

    /**
     * Get horacierresemana
     *
     * @return \DateTime 
     */
    public function getHoracierresemana()
    {
        return $this->horacierresemana;
    }

    /**
     * Set horaaperturasabado
     *
     * @param \DateTime $horaaperturasabado
     * @return Clinica
     */
    public function setHoraaperturasabado($horaaperturasabado)
    {
        $this->horaaperturasabado = $horaaperturasabado;
    
        return $this;
    }

    /**
     * Get horaaperturasabado
     *
     * @return \DateTime 
     */
    public function getHoraaperturasabado()
    {
        return $this->horaaperturasabado;
    }

    /**
     * Set horacierresabado
     *
     * @param \DateTime $horacierresabado
     * @return Clinica
     */
    public function setHoracierresabado($horacierresabado)
    {
        $this->horacierresabado = $horacierresabado;
    
        return $this;
    }

    /**
     * Get horacierresabado
     *
     * @return \DateTime 
     */
    public function getHoracierresabado()
    {
        return $this->horacierresabado;
    }

    /**
     * Set horaaperturadomingo
     *
     * @param \DateTime $horaaperturadomingo
     * @return Clinica
     */
    public function setHoraaperturadomingo($horaaperturadomingo)
    {
        $this->horaaperturadomingo = $horaaperturadomingo;
    
        return $this;
    }

    /**
     * Get horaaperturadomingo
     *
     * @return \DateTime 
     */
    public function getHoraaperturadomingo()
    {
        return $this->horaaperturadomingo;
    }

    /**
     * Set horacierredomingo
     *
     * @param \DateTime $horacierredomingo
     * @return Clinica
     */
    public function setHoracierredomingo($horacierredomingo)
    {
        $this->horacierredomingo = $horacierredomingo;
    
        return $this;
    }

    /**
     * Get horacierredomingo
     *
     * @return \DateTime 
     */
    public function getHoracierredomingo()
    {
        return $this->horacierredomingo;
    }

    /**
     * Set mesesagendar
     *
     * @param integer $anticipacioncita
     * @return Clinica
     */
    public function setAnticipacioncita($anticipacioncita)
    {
        $this->anticipacioncita = $anticipacioncita;
    
        return $this;
    }

    /**
     * Get anticipacioncita
     *
     * @return integer 
     */
    public function getAnticipacioncita()
    {
        return $this->anticipacioncita;
    }

    /**
     * Set estadoactivacion
     *
     * @param boolean $estadoactivacion
     * @return Clinica
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
     * Add disponibilidad
     *
     * @param \Asi\ClinicaBundle\Entity\Dispo $agenda
     * @return Clinica
     */
    public function addDisponibilidad(\Asi\ClinicaBundle\Entity\Disponibilidad $disponibilidad)
    {
        $this->disponibilidad[] = $disponibilidad;
    
        return $this;
    }

    /**
     * Remove disponibilidad
     *
     * @param \Asi\ClinicaBundle\Entity\Disponibilidad $disponibilidad
     */
    public function removeDisponibilidad(\Asi\ClinicaBundle\Entity\Disponibilidad $disponibilidad)
    {
        $this->disponibilidad->removeElement($disponibilidad);
    }

    /**
     * Get disponibilidad
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDisponibilidad()
    {
        return $this->disponibilidad;
    }
    public function __toString(){
        return $this->nombre;
    }

    /**
     * Set idmunicipio
     *
     * @param \Asi\ClinicaBundle\Entity\Municipio $idmunicipio
     * @return Clinica
     */
    public function setIdmunicipio(\Asi\ClinicaBundle\Entity\Municipio $idmunicipio = null)
    {
        $this->idmunicipio = $idmunicipio;
    
        return $this;
    }

    /**
     * Get idmunicipio
     *
     * @return \Asi\ClinicaBundle\Entity\Municipio 
     */
    public function getIdmunicipio()
    {
        return $this->idmunicipio;
    }

    /**
     * Set idespecialidad
     *
     * @param \Asi\ClinicaBundle\Entity\Especialidad $idespecialidad
     * @return Clinica
     */
    public function setIdespecialidad(\Asi\ClinicaBundle\Entity\Especialidad $idespecialidad = null)
    {
        $this->idespecialidad = $idespecialidad;
    
        return $this;
    }

    /**
     * Get idespecialidad
     *
     * @return \Asi\ClinicaBundle\Entity\Especialidad 
     */
    public function getIdespecialidad()
    {
        return $this->idespecialidad;
    }
}
