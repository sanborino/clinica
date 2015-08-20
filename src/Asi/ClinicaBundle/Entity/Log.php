<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 */
class Log
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fechahora;

    /**
     * @var string
     */
    private $accion;

    /**
     * @var \Asi\ClinicaBundle\Entity\Pantalla
     */
    private $idpantalla;

    /**
     * @var \Asi\ClinicaBundle\Entity\Usuario
     */
    private $idusuario;


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
     * Set fechahora
     *
     * @param \DateTime $fechahora
     * @return Log
     */
    public function setFechahora($fechahora)
    {
        $this->fechahora = $fechahora;
    
        return $this;
    }

    /**
     * Get fechahora
     *
     * @return \DateTime 
     */
    public function getFechahora()
    {
        return $this->fechahora;
    }

    /**
     * Set accion
     *
     * @param string $accion
     * @return Log
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;
    
        return $this;
    }

    /**
     * Get accion
     *
     * @return string 
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set idpantalla
     *
     * @param \Asi\ClinicaBundle\Entity\Pantalla $idpantalla
     * @return Log
     */
    public function setIdpantalla(\Asi\ClinicaBundle\Entity\Pantalla $idpantalla = null)
    {
        $this->idpantalla = $idpantalla;
    
        return $this;
    }

    /**
     * Get idpantalla
     *
     * @return \Asi\ClinicaBundle\Entity\Pantalla 
     */
    public function getIdpantalla()
    {
        return $this->idpantalla;
    }

    /**
     * Set idusuario
     *
     * @param \Asi\ClinicaBundle\Entity\Usuario $idusuario
     * @return Log
     */
    public function setIdusuario(\Asi\ClinicaBundle\Entity\Usuario $idusuario = null)
    {
        $this->idusuario = $idusuario;
    
        return $this;
    }

    /**
     * Get idusuario
     *
     * @return \Asi\ClinicaBundle\Entity\Usuario 
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }
}
