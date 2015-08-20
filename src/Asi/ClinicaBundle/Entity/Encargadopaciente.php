<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Encargadopaciente
 */
class Encargadopaciente
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $parentesco;

    /**
     * @var \Asi\ClinicaBundle\Entity\Encargado
     */
    private $idencargado;

    /**
     * @var \Asi\ClinicaBundle\Entity\Paciente
     */
    private $idpaciente;


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
     * Set parentesco
     *
     * @param string $parentesco
     * @return Encargadopaciente
     */
    public function setParentesco($parentesco)
    {
        $this->parentesco = $parentesco;
    
        return $this;
    }

    /**
     * Get parentesco
     *
     * @return string 
     */
    public function getParentesco()
    {
        return $this->parentesco;
    }

    /**
     * Set idencargado
     *
     * @param \Asi\ClinicaBundle\Entity\Encargado $idencargado
     * @return Encargadopaciente
     */
    public function setIdencargado(\Asi\ClinicaBundle\Entity\Encargado $idencargado = null)
    {
        $this->idencargado = $idencargado;
    
        return $this;
    }

    /**
     * Get idencargado
     *
     * @return \Asi\ClinicaBundle\Entity\Encargado 
     */
    public function getIdencargado()
    {
        return $this->idencargado;
    }

    /**
     * Set idpaciente
     *
     * @param \Asi\ClinicaBundle\Entity\Paciente $idpaciente
     * @return Encargadopaciente
     */
    public function setIdpaciente(\Asi\ClinicaBundle\Entity\Paciente $idpaciente = null)
    {
        $this->idpaciente = $idpaciente;
    
        return $this;
    }

    /**
     * Get idpaciente
     *
     * @return \Asi\ClinicaBundle\Entity\Paciente 
     */
    public function getIdpaciente()
    {
        return $this->idpaciente;
    }
    
}
