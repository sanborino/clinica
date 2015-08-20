<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consulta
 */
class Consulta
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $motivoconsulta;

    /**
     * @var string
     */
    private $diagnostico;

    /**
     * @var string
     */
    private $sintomas;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var \DateTime
     */
    private $hora;

    /**
     * @var \Asi\ClinicaBundle\Entity\Cita
     */
    private $idcita;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $inmunizacion;

    /**
     * @var \Asi\ClinicaBundle\Entity\Factura
     */
    private $idfactura;

    /**
     * @var \Asi\ClinicaBundle\Entity\Medico
     */
    private $idmedico;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $consultaitem;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $diagnosticopatologia;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->consultaitem = new \Doctrine\Common\Collections\ArrayCollection();
        $this->inmunizacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->diagnosticopatologia = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set motivoconsulta
     *
     * @param string $motivoconsulta
     * @return Consulta
     */
    public function setMotivoconsulta($motivoconsulta)
    {
        $this->motivoconsulta = $motivoconsulta;
    
        return $this;
    }

    /**
     * Get motivoconsulta
     *
     * @return string 
     */
    public function getMotivoconsulta()
    {
        return $this->motivoconsulta;
    }

    /**
     * Set diagnostico
     *
     * @param string $diagnostico
     * @return Consulta
     */
    public function setDiagnostico($diagnostico)
    {
        $this->diagnostico = $diagnostico;
    
        return $this;
    }

    /**
     * Get diagnostico
     *
     * @return string 
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
    }

    /**
     * Set sintomas
     *
     * @param string $sintomas
     * @return Consulta
     */
    public function setSintomas($sintomas)
    {
        $this->sintomas = $sintomas;
    
        return $this;
    }

    /**
     * Get sintomas
     *
     * @return string 
     */
    public function getSintomas()
    {
        return $this->sintomas;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Consulta
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Consulta
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set hora
     *
     * @param \DateTime $hora
     * @return Consulta
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    
        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime 
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set idcita
     *
     * @param \Asi\ClinicaBundle\Entity\Cita $idcita
     * @return Consulta
     */
    public function setIdcita(\Asi\ClinicaBundle\Entity\Cita $idcita = null)
    {
        $this->idcita = $idcita;
    
        return $this;
    }

    /**
     * Get idcita
     *
     * @return \Asi\ClinicaBundle\Entity\Cita 
     */
    public function getIdcita()
    {
        return $this->idcita;
    }

    /**
     * Add inmunizacion
     *
     * @param \Asi\ClinicaBundle\Entity\Inmunizacion $inmunizacion
     * @return Consulta
     */
    public function addInmunizacion(\Asi\ClinicaBundle\Entity\Inmunizacion $inmunizacion)
    {
        $this->inmunizacion[] = $inmunizacion;
    
        return $this;
    }

    /**
     * Remove inmunizacion
     *
     * @param \Asi\ClinicaBundle\Entity\Inmunizacion $inmunizacion
     */
    public function removeInmunizacion(\Asi\ClinicaBundle\Entity\Inmunizacion $inmunizacion)
    {
        $this->inmunizacion->removeElement($inmunizacion);
    }

    /**
     * Get inmunizacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInmunizacion()
    {
        return $this->inmunizacion;
    }

    /**
     * Set idfactura
     *
     * @param \Asi\ClinicaBundle\Entity\Factura $idfactura
     * @return Consulta
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set idmedico
     *
     * @param \Asi\ClinicaBundle\Entity\Medico $idmedico
     * @return Consulta
     */
    public function setIdmedico(\Asi\ClinicaBundle\Entity\Medico $idmedico = null)
    {
        $this->idmedico = $idmedico;
    
        return $this;
    }

    /**
     * Get idmedico
     *
     * @return \Asi\ClinicaBundle\Entity\Medico 
     */
    public function getIdmedico()
    {
        return $this->idmedico;
    }

    /**
     * Add consultaitem
     *
     * @param \Asi\ClinicaBundle\Entity\Consultaitem $consultaitem
     * @return Consultaitem
     */
    public function addConsultaitem(\Asi\ClinicaBundle\Entity\Consultaitem $consultaitem)
    {
        $this->consultaitem[] = $consultaitem;
    
        return $this;
    }

    /**
     * Remove consultaitem
     *
     * @param \Asi\ClinicaBundle\Entity\Consultaitem $consultaitem
     */
    public function removeConsultaitem(\Asi\ClinicaBundle\Entity\Consultaitem $consultaitem)
    {
        $this->consultaitem->removeElement($consultaitem);
    }

    /**
     * Get consultaitem
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConsultaitem()
    {
        return $this->consultaitem;
    }

    /**
     * Add diagnosticopatologia
     *
     * @param \Asi\ClinicaBundle\Entity\Diagnosticopatologia $diagnosticopatologia
     * @return Diagnosticopatologia
     */
    public function addDiagnosticopatologia(\Asi\ClinicaBundle\Entity\Diagnosticopatologia $diagnosticopatologia)
    {
        $this->diagnosticopatologia[] = $diagnosticopatologia;
    
        return $this;
    }

    /**
     * Remove diagnosticopatologia
     *
     * @param \Asi\ClinicaBundle\Entity\Diagnosticopatologia $diagnosticopatologia
     */
    public function removeDiagnosticopatologia(\Asi\ClinicaBundle\Entity\Diagnosticopatologia $diagnosticopatologia)
    {
        $this->diagnosticopatologia->removeElement($diagnosticopatologia);
    }

    /**
     * Get diagnosticopatologia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiagnosticopatologia()
    {
        return $this->diagnosticopatologia;
    }

    public function getFechaHora()
    {
        return sprintf('%s - %s', $this->fecha->format('Y-m-d'), $this->hora->format('H:i'));
    }
}
