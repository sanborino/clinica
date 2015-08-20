<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Patologia
 */
class Patologia
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $pacientepatologia;

    /**
     * @var \Asi\ClinicaBundle\Entity\Tipopatologia
     */
    private $idtipopatologia;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pacientepatologia = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Patologia
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
     * @return Patologia
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
     * Add pacientepatologia
     *
     * @param \Asi\ClinicaBundle\Entity\Pacientepatologia $pacientepatologia
     * @return Patologia
     */
    public function addPacientepatologium(\Asi\ClinicaBundle\Entity\Pacientepatologia $pacientepatologia)
    {
        $this->pacientepatologia[] = $pacientepatologia;
    
        return $this;
    }

    /**
     * Remove pacientepatologia
     *
     * @param \Asi\ClinicaBundle\Entity\Pacientepatologia $pacientepatologia
     */
    public function removePacientepatologium(\Asi\ClinicaBundle\Entity\Pacientepatologia $pacientepatologia)
    {
        $this->pacientepatologia->removeElement($pacientepatologia);
    }

    /**
     * Get pacientepatologia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPacientepatologia()
    {
        return $this->pacientepatologia;
    }

    /**
     * Set idtipopatologia
     *
     * @param \Asi\ClinicaBundle\Entity\Tipopatologia $idtipopatologia
     * @return Patologia
     */
    public function setIdtipopatologia(\Asi\ClinicaBundle\Entity\Tipopatologia $idtipopatologia = null)
    {
        $this->idtipopatologia = $idtipopatologia;
    
        return $this;
    }

    /**
     * Get idtipopatologia
     *
     * @return \Asi\ClinicaBundle\Entity\Tipopatologia 
     */
    public function getIdtipopatologia()
    {
        return $this->idtipopatologia;
    }
    
}
