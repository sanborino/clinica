<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personalclinica
 */
class Personalclinica
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
     * @var \Asi\ClinicaBundle\Entity\Personal
     */
    private $idpersonal;


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
     * @return Personalclinica
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
     * Set idpersonal
     *
     * @param \Asi\ClinicaBundle\Entity\Personal $idpersonal
     * @return Personalclinica
     */
    public function setIdpersonal(\Asi\ClinicaBundle\Entity\Personal $idpersonal = null)
    {
        $this->idpersonal = $idpersonal;

        return $this;
    }

    /**
     * Get idpersonal
     *
     * @return \Asi\ClinicaBundle\Entity\Personal 
     */
    public function getIdpersonal()
    {
        return $this->idpersonal;
    }
}
