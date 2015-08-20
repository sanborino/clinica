<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipomedicamento
 */
class Tipomedicamento
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
    private $medicamento;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medicamento = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Tipomedicamento
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
     * @return Tipomedicamento
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
     * Add medicamento
     *
     * @param \Asi\ClinicaBundle\Entity\Medicamento $medicamento
     * @return Tipomedicamento
     */
    public function addMedicamento(\Asi\ClinicaBundle\Entity\Medicamento $medicamento)
    {
        $this->medicamento[] = $medicamento;
    
        return $this;
    }

    /**
     * Remove medicamento
     *
     * @param \Asi\ClinicaBundle\Entity\Medicamento $medicamento
     */
    public function removeMedicamento(\Asi\ClinicaBundle\Entity\Medicamento $medicamento)
    {
        $this->medicamento->removeElement($medicamento);
    }

    /**
     * Get medicamento
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedicamento()
    {
        return $this->medicamento;
    }
   
}
