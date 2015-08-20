<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clinicapolitica
 */
class Clinicapolitica
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Asi\ClinicaBundle\Entity\Clinica
     */
    private $idclinica;

    /**
     * @var \Asi\ClinicaBundle\Entity\Politica
     */
    private $idpolitica;


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
     * Set idclinica
     *
     * @param \Asi\ClinicaBundle\Entity\Clinica $idclinica
     * @return Clinicapolitica
     */
    public function setIdclinica(\Asi\ClinicaBundle\Entity\Clinica $idclinica = null)
    {
        $this->idclinica = $idclinica;
    
        return $this;
    }

    /**
     * Get idclinica
     *
     * @return \Asi\ClinicaBundle\Entity\Clinica 
     */
    public function getIdclinica()
    {
        return $this->idclinica;
    }

    /**
     * Set idpolitica
     *
     * @param \Asi\ClinicaBundle\Entity\Politica $idpolitica
     * @return Clinicapolitica
     */
    public function setIdpolitica(\Asi\ClinicaBundle\Entity\Politica $idpolitica = null)
    {
        $this->idpolitica = $idpolitica;
    
        return $this;
    }

    /**
     * Get idpolitica
     *
     * @return \Asi\ClinicaBundle\Entity\Politica 
     */
    public function getIdpolitica()
    {
        return $this->idpolitica;
    }
}
