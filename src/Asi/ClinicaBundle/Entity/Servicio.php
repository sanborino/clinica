<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicio
 */
class Servicio
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
    private $precio;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $detallefactura;

    /**
     * @var \Asi\ClinicaBundle\Entity\Tiposervicio
     */
    private $idtiposervicio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->detallefactura = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Servicio
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
     * Set precio
     *
     * @param string $precio
     * @return Servicio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return string 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Add detallefactura
     *
     * @param \Asi\ClinicaBundle\Entity\Detallefactura $detallefactura
     * @return Servicio
     */
    public function addDetallefactura(\Asi\ClinicaBundle\Entity\Detallefactura $detallefactura)
    {
        $this->detallefactura[] = $detallefactura;
    
        return $this;
    }

    /**
     * Remove detallefactura
     *
     * @param \Asi\ClinicaBundle\Entity\Detallefactura $detallefactura
     */
    public function removeDetallefactura(\Asi\ClinicaBundle\Entity\Detallefactura $detallefactura)
    {
        $this->detallefactura->removeElement($detallefactura);
    }

    /**
     * Get detallefactura
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDetallefactura()
    {
        return $this->detallefactura;
    }

    /**
     * Set idtiposervicio
     *
     * @param \Asi\ClinicaBundle\Entity\Tiposervicio $idtiposervicio
     * @return Servicio
     */
    public function setIdtiposervicio(\Asi\ClinicaBundle\Entity\Tiposervicio $idtiposervicio = null)
    {
        $this->idtiposervicio = $idtiposervicio;
    
        return $this;
    }

    /**
     * Get idtiposervicio
     *
     * @return \Asi\ClinicaBundle\Entity\Tiposervicio 
     */
    public function getIdtiposervicio()
    {
        return $this->idtiposervicio;
    }
    public function __toString(){
        return $this->nombre;
    }
    /**
     * @var \Asi\ClinicaBundle\Entity\Vacuna
     */
    private $idservicio;


    /**
     * Set idservicio
     *
     * @param \Asi\ClinicaBundle\Entity\Vacuna $idservicio
     * @return Servicio
     */
    public function setIdservicio(\Asi\ClinicaBundle\Entity\Vacuna $idservicio = null)
    {
        $this->idservicio = $idservicio;
    
        return $this;
    }

    /**
     * Get idservicio
     *
     * @return \Asi\ClinicaBundle\Entity\Vacuna 
     */
    public function getIdservicio()
    {
        return $this->idservicio;
    }
}
