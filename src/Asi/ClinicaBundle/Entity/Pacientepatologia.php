<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Pacientepatologia
 */
class Pacientepatologia
{

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        
        $metadata->addConstraint(new Assert\Callback('fechaMayor'));

    }

    public function fechaMayor(ExecutionContextInterface $context)
    {
        if ($this->getIdpaciente()) {
            if ($this->getFechadiagnostico() < $this->getIdpaciente()->getFechanacimiento()) {
                $context->buildViolation(sprintf('Esta fecha no puede ser menor que la fecha de nacimiento del paciente. (%s)', $this->getIdpaciente()->getFechanacimiento()->format('Y-m-d')))
                    ->atPath('fechadiagnostico')
                    ->addViolation();
            }
        }
        if ($this->getFechadiagnostico() > new \DateTime('today')) {
            $context->buildViolation('Esta fecha no puede ser mayor que la fecha de hoy.')
                ->atPath('fechadiagnostico')
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
    private $fechadiagnostico;

    /**
     * @var boolean
     */
    private $importante;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var \Asi\ClinicaBundle\Entity\Paciente
     */
    private $idpaciente;

    /**
     * @var \Asi\ClinicaBundle\Entity\Patologia
     */
    private $idpatologia;

    /**
     * @var \Asi\ClinicaBundle\Entity\Diagnosticopatologia
     */
    private $diagnosticopatologia;

    /**
     * Constructor
     */
    public function __construct()
    {

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
     * Set fechadiagnostico
     *
     * @param \DateTime $fechadiagnostico
     * @return Pacientepatologia
     */
    public function setFechadiagnostico($fechadiagnostico)
    {
        $this->fechadiagnostico = $fechadiagnostico;
    
        return $this;
    }

    /**
     * Get fechadiagnostico
     *
     * @return \DateTime 
     */
    public function getFechadiagnostico()
    {
        return $this->fechadiagnostico;
    }

    /**
     * Set importante
     *
     * @param boolean $importante
     * @return Pacientepatologia
     */
    public function setImportante($importante)
    {
        $this->importante = $importante;
    
        return $this;
    }

    /**
     * Get importante
     *
     * @return boolean 
     */
    public function getImportante()
    {
        return $this->importante;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Pacientepatologia
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
     * Set idpaciente
     *
     * @param \Asi\ClinicaBundle\Entity\Paciente $idpaciente
     * @return Pacientepatologia
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

    /**
     * Set idpatologia
     *
     * @param \Asi\ClinicaBundle\Entity\Patologia $idpatologia
     * @return Pacientepatologia
     */
    public function setIdpatologia(\Asi\ClinicaBundle\Entity\Patologia $idpatologia = null)
    {
        $this->idpatologia = $idpatologia;
    
        return $this;
    }

    /**
     * Get idpatologia
     *
     * @return \Asi\ClinicaBundle\Entity\Patologia 
     */
    public function getIdpatologia()
    {
        return $this->idpatologia;
    }

    public function getNombresPaciente(){
        return sprintf('%s - %s', $this->idpaciente->getNombres(), $this->idpatologia->getNombre());
    }

    /**
     * Get diagnosticopatologia
     *
     * @return \Asi\ClinicaBundle\Entity\Diagnosticopatologia 
     */
    public function getDiagnosticopatologia()
    {
        return $this->diagnosticopatologia;
    }
}
