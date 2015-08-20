<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipoexamen
 */
class Tipoexamen
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
    private $examen;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->examen = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Tipoexamen
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
     * @return Tipoexamen
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
     * Add examen
     *
     * @param \Asi\ClinicaBundle\Entity\Examen $examen
     * @return Tipoexamen
     */
    public function addExaman(\Asi\ClinicaBundle\Entity\Examen $examen)
    {
        $this->examen[] = $examen;
    
        return $this;
    }

    /**
     * Remove examen
     *
     * @param \Asi\ClinicaBundle\Entity\Examen $examen
     */
    public function removeExaman(\Asi\ClinicaBundle\Entity\Examen $examen)
    {
        $this->examen->removeElement($examen);
    }

    /**
     * Get examen
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExamen()
    {
        return $this->examen;
    }
    
}
