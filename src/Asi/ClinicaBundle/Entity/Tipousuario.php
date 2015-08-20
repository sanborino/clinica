<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipousuario
 */
class Tipousuario
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
    private $usuario;

    /**
     * @var \Asi\ClinicaBundle\Entity\PantallaAcceso
     */
    private $pantallaAcceso;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pantallaAcceso = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Tipousuario
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
     * @return Tipousuario
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
     * Add usuario
     *
     * @param \Asi\ClinicaBundle\Entity\Usuario $usuario
     * @return Tipousuario
     */
    public function addUsuario(\Asi\ClinicaBundle\Entity\Usuario $usuario)
    {
        $this->usuario[] = $usuario;
    
        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \Asi\ClinicaBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\Asi\ClinicaBundle\Entity\Usuario $usuario)
    {
        $this->usuario->removeElement($usuario);
    }

    /**
     * Get usuario
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuario()
    {
        return $this->usuario;
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
