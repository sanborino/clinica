<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pantalla
 */
class Pantalla
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
     * @var string
     */
    private $dirpantalla;

    /**
     * @var boolean
     */
    private $estadoactivacion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $pantallaAcceso;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pantallaAcceso = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Pantalla
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
     * @return Pantalla
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
     * Set dirpantalla
     *
     * @param string $dirpantalla
     * @return Pantalla
     */
    public function setDirpantalla($dirpantalla)
    {
        $this->dirpantalla = $dirpantalla;
    
        return $this;
    }

    /**
     * Get dirpantalla
     *
     * @return string 
     */
    public function getDirpantalla()
    {
        return $this->dirpantalla;
    }

    /**
     * Set estadoactivacion
     *
     * @param boolean $estadoactivacion
     * @return Pantalla
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
     * Set pantallaAcceso
     *
     * @param \Asi\ClinicaBundle\Entity\PantallaAcceso $pantallaAcceso
     * @return PantallaAcceso
     */
    public function setPantallaAcceso(\Asi\ClinicaBundle\Entity\PantallaAcceso $pantallaAcceso = null)
    {
        $this->pantallaAcceso = $pantallaAcceso;
    
        return $this;
    }

    /**
     * Get pantallaAcceso
     *
     * @return \Asi\ClinicaBundle\Entity\PantallaAcceso 
     */
    public function getPantallaAcceso()
    {
        return $this->pantallaAcceso;
    }
}
