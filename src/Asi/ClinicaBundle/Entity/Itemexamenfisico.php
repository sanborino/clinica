<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Itemexamenfisico
 */
class Itemexamenfisico
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
    private $tipodato;

    /**
     * @var boolean
     */
    private $universal;

    /**
     * @var boolean
     */
    private $estadoactivacion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $itemespecialidad;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->itemespecialidad = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Itemexamenfisico
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
     * Set tipodato
     *
     * @param string $tipodato
     * @return Itemexamenfisico
     */
    public function setTipodato($tipodato)
    {
        $this->tipodato = $tipodato;
    
        return $this;
    }

    /**
     * Get tipodato
     *
     * @return string 
     */
    public function getTipodato()
    {
        return $this->tipodato;
    }

    /**
     * Set universal
     *
     * @param boolean $universal
     * @return Itemexamenfisico
     */
    public function setUniversal($universal)
    {
        $this->universal = $universal;
    
        return $this;
    }

    /**
     * Get universal
     *
     * @return boolean 
     */
    public function getUniversal()
    {
        return $this->universal;
    }

    /**
     * Set estadoactivacion
     *
     * @param boolean $estadoactivacion
     * @return Itemexamenfisico
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
     * Add itemespecialidad
     *
     * @param \Asi\ClinicaBundle\Entity\Itemespecialidad $itemespecialidad
     * @return Itemexamenfisico
     */
    public function addItemespecialidad(\Asi\ClinicaBundle\Entity\Itemespecialidad $itemespecialidad)
    {
        $this->itemespecialidad[] = $itemespecialidad;
    
        return $this;
    }

    /**
     * Remove itemespecialidad
     *
     * @param \Asi\ClinicaBundle\Entity\Itemespecialidad $itemespecialidad
     */
    public function removeItemespecialidad(\Asi\ClinicaBundle\Entity\Itemespecialidad $itemespecialidad)
    {
        $this->itemespecialidad->removeElement($itemespecialidad);
    }

    /**
     * Get itemespecialidad
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItemespecialidad()
    {
        return $this->itemespecialidad;
    }
    
}
