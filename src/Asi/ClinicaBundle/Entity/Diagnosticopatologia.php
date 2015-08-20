<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagnosticopatologia
 */
class Diagnosticopatologia
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Asi\ClinicaBundle\Entity\Consulta
     */
    private $idconsulta;

    /**
     * @var \Asi\ClinicaBundle\Entity\Pacientepatologia
     */
    private $idpacientepatologia;


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
     * Set idconsulta
     *
     * @param \Asi\ClinicaBundle\Entity\Consulta $idconsulta
     * @return Diagnosticopatologia
     */
    public function setIdconsulta(\Asi\ClinicaBundle\Entity\Consulta $idconsulta = null)
    {
        $this->idconsulta = $idconsulta;
    
        return $this;
    }

    /**
     * Get idconsulta
     *
     * @return \Asi\ClinicaBundle\Entity\Consulta 
     */
    public function getIdconsulta()
    {
        return $this->idconsulta;
    }

    /**
     * Set idpacientepatologia
     *
     * @param \Asi\ClinicaBundle\Entity\Pacientepatologia $idpacientepatologia
     * @return Diagnosticopatologia
     */
    public function setIdpacientepatologia(\Asi\ClinicaBundle\Entity\Pacientepatologia $idpacientepatologia = null)
    {
        $this->idpacientepatologia = $idpacientepatologia;
    
        return $this;
    }

    /**
     * Get idpacientepatologia
     *
     * @return \Asi\ClinicaBundle\Entity\Pacientepatologia 
     */
    public function getIdpacientepatologia()
    {
        return $this->idpacientepatologia;
    }
}
