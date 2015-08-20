<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Detallefactura
 */
class Detallefactura
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $precio;

    /**
     * @var string
     */
    private $descuento;

    /**
     * @var integer
     */
    private $cantidad;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var boolean
     */
    private $facturado;

    /**
     * @var \Asi\ClinicaBundle\Entity\Factura
     */
    private $idfactura;

    /**
     * @var \Asi\ClinicaBundle\Entity\Servicio
     */
    private $idservicio;


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
     * Set precio
     *
     * @param string $precio
     * @return Detallefactura
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
     * Set descuento
     *
     * @param string $descuento
     * @return Detallefactura
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    
        return $this;
    }

    /**
     * Get descuento
     *
     * @return string 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Detallefactura
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Detallefactura
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    
        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set facturado
     *
     * @param boolean $facturado
     * @return Detallefactura
     */
    public function setFacturado($facturado)
    {
        $this->facturado = $facturado;
    
        return $this;
    }

    /**
     * Get facturado
     *
     * @return boolean 
     */
    public function getFacturado()
    {
        return $this->facturado;
    }

    /**
     * Set idfactura
     *
     * @param \Asi\ClinicaBundle\Entity\Factura $idfactura
     * @return Detallefactura
     */
    public function setIdfactura(\Asi\ClinicaBundle\Entity\Factura $idfactura = null)
    {
        $this->idfactura = $idfactura;
    
        return $this;
    }

    /**
     * Get idfactura
     *
     * @return \Asi\ClinicaBundle\Entity\Factura 
     */
    public function getIdfactura()
    {
        return $this->idfactura;
    }

    /**
     * Set idservicio
     *
     * @param \Asi\ClinicaBundle\Entity\Servicio $idservicio
     * @return Detallefactura
     */
    public function setIdservicio(\Asi\ClinicaBundle\Entity\Servicio $idservicio = null)
    {
        $this->idservicio = $idservicio;
    
        return $this;
    }

    /**
     * Get idservicio
     *
     * @return \Asi\ClinicaBundle\Entity\Servicio 
     */
    public function getIdservicio()
    {
        return $this->idservicio;
    }
}
