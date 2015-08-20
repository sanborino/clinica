<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Factura
 */
class Factura
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $titular;

    /**
     * @var string
     */
    private $dui;

    /**
     * @var string
     */
    private $nit;

    /**
     * @var \DateTime
     */
    private $fechahoraemision;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $detallefactura;

    /**
     * @var \Asi\ClinicaBundle\Entity\Consulta
     */
    private $idconsulta;

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
     * Set titular
     *
     * @param string $titular
     * @return Factura
     */
    public function setTitular($titular)
    {
        $this->titular = $titular;
    
        return $this;
    }

    /**
     * Get titular
     *
     * @return string 
     */
    public function getTitular()
    {
        return $this->titular;
    }

    /**
     * Set dui
     *
     * @param string $dui
     * @return Factura
     */
    public function setDui($dui)
    {
        $this->dui = $dui;
    
        return $this;
    }

    /**
     * Get dui
     *
     * @return string 
     */
    public function getDui()
    {
        return $this->dui;
    }

    /**
     * Set nit
     *
     * @param string $nit
     * @return Factura
     */
    public function setNit($nit)
    {
        $this->nit = $nit;
    
        return $this;
    }

    /**
     * Get nit
     *
     * @return string 
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * Set fechahoraemision
     *
     * @param \DateTime $fechahoraemision
     * @return Factura
     */
    public function setFechahoraemision($fechahoraemision)
    {
        $this->fechahoraemision = $fechahoraemision;
    
        return $this;
    }

    /**
     * Get fechahoraemision
     *
     * @return \DateTime 
     */
    public function getFechahoraemision()
    {
        return $this->fechahoraemision;
    }

    /**
     * Add detallefactura
     *
     * @param \Asi\ClinicaBundle\Entity\Detallefactura $detallefactura
     * @return Factura
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
    public function getTitularDui(){

        return $this->titular . " " . $this->dui;
    }

    public function getIdconsulta()
    {
        return $this->idconsulta;
    }

}
