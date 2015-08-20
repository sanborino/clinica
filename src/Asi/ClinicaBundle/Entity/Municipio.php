<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipio
 */
class Municipio
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $encargado;

    /**
     * @var \Asi\ClinicaBundle\Entity\Departamento
     */
    private $iddepartamento;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->encargado = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Municipio
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
     * Add encargado
     *
     * @param \Asi\ClinicaBundle\Entity\Encargado $encargado
     * @return Municipio
     */
    public function addEncargado(\Asi\ClinicaBundle\Entity\Encargado $encargado)
    {
        $this->encargado[] = $encargado;
    
        return $this;
    }

    /**
     * Remove encargado
     *
     * @param \Asi\ClinicaBundle\Entity\Encargado $encargado
     */
    public function removeEncargado(\Asi\ClinicaBundle\Entity\Encargado $encargado)
    {
        $this->encargado->removeElement($encargado);
    }

    /**
     * Get encargado
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEncargado()
    {
        return $this->encargado;
    }

    /**
     * Set iddepartamento
     *
     * @param \Asi\ClinicaBundle\Entity\Departamento $iddepartamento
     * @return Municipio
     */
    public function setIddepartamento(\Asi\ClinicaBundle\Entity\Departamento $iddepartamento = null)
    {
        $this->iddepartamento = $iddepartamento;
    
        return $this;
    }

    /**
     * Get iddepartamento
     *
     * @return \Asi\ClinicaBundle\Entity\Departamento 
     */
    public function getIddepartamento()
    {
        return $this->iddepartamento;
    }
    
}
