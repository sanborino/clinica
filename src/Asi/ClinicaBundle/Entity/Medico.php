<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medico
 */
class Medico
{
    /**
     * @var string
     */
    private $jvpm;

    /**
     * @var string
     */
    private $hospitalresidente;

    /**
     * @var \Asi\ClinicaBundle\Entity\Personal
     */
    private $idpersonal;


    /**
     * Set jvpm
     *
     * @param string $jvpm
     * @return Medico
     */
    public function setJvpm($jvpm)
    {
        $this->jvpm = $jvpm;
    
        return $this;
    }

    /**
     * Get jvpm
     *
     * @return string 
     */
    public function getJvpm()
    {
        return $this->jvpm;
    }

    /**
     * Set hospitalresidente
     *
     * @param string $hospitalresidente
     * @return Medico
     */
    public function setHospitalresidente($hospitalresidente)
    {
        $this->hospitalresidente = $hospitalresidente;
    
        return $this;
    }

    /**
     * Get hospitalresidente
     *
     * @return string 
     */
    public function getHospitalresidente()
    {
        return $this->hospitalresidente;
    }

    /**
     * Set idpersonal
     *
     * @param \Asi\ClinicaBundle\Entity\Personal $idpersonal
     * @return Medico
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
    /**
     * @var integer
     */
    private $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function getNombresApellidos(){
        return $this->idpersonal->getNombres(). " " . $this->idpersonal->getApellidos();
    }
}
