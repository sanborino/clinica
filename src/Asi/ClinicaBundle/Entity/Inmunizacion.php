<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Inmunizacion
 */
class Inmunizacion
{

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        
        $metadata->addConstraint(new Assert\Callback('fechaMayor'));

    }

    public function fechaMayor(ExecutionContextInterface $context)
    {
        if ($this->getIdpaciente()) {
            if ($this->getFechatomada() < $this->getIdpaciente()->getFechanacimiento()) {
                $context->buildViolation(sprintf('Esta fecha no puede ser menor que la fecha de nacimiento del paciente. (%s)', $this->getIdpaciente()->getFechanacimiento()->format('Y-m-d')))
                    ->atPath('fechatomada')
                    ->addViolation();
            }
        }
        if ($this->getFechatomada() > new \DateTime('today')) {
            $context->buildViolation('Esta fecha no puede ser mayor que la fecha de hoy.')
                ->atPath('fechatomada')
                ->addViolation();
        }
        
    }

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fechatomada;

    /**
     * @var \Asi\ClinicaBundle\Entity\Vacuna
     */
    private $idvacuna;

    /**
     * @var \Asi\ClinicaBundle\Entity\Consulta
     */
    private $idconsulta;

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
     * Set fechatomada
     *
     * @param \DateTime $fechatomada
     * @return Inmunizacion
     */
    public function setFechatomada($fechatomada)
    {
        $this->fechatomada = $fechatomada;
    
        return $this;
    }

    /**
     * Get fechatomada
     *
     * @return \DateTime 
     */
    public function getFechatomada()
    {
        return $this->fechatomada;
    }

    /**
     * Set idvacuna
     *
     * @param \Asi\ClinicaBundle\Entity\Vacuna $idvacuna
     * @return Inmunizacion
     */
    public function setIdvacuna(\Asi\ClinicaBundle\Entity\Vacuna $idvacuna = null)
    {
        $this->idvacuna = $idvacuna;
    
        return $this;
    }

    /**
     * Get idvacuna
     *
     * @return \Asi\ClinicaBundle\Entity\Vacuna 
     */
    public function getIdvacuna()
    {
        return $this->idvacuna;
    }

    /**
     * Set idconsulta
     *
     * @param \Asi\ClinicaBundle\Entity\Consulta $idconsulta
     * @return Inmunizacion
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
     * Set idpaciente
     *
     * @param \Asi\ClinicaBundle\Entity\Paciente $idpaciente
     * @return Inmunizacion
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
