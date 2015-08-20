<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Paciente
 */
class Paciente
{

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        
        $metadata->addConstraint(new Assert\Callback('fechaMayor'));

    }

    public function fechaMayor(ExecutionContextInterface $context)
    {
        
        if ($this->getFechanacimiento() > new \DateTime('today')) {
            $context->buildViolation('No puede haber nacido en el futuro.')
                ->atPath('fechanacimiento')
                ->addViolation();
        }
        
    }

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $dui;

    /**
     * @var string
     */
    private $nombres;

    /**
     * @var string
     */
    private $apellidos;

    /**
     * @var string
     */
    private $genero;

    /**
     * @var \DateTime
     */
    private $fechanacimiento;

    /**
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $movil;

    /**
     * @var string
     */
    private $referidopor;

    /**
     * @var string
     */
    private $lugarnacimiento;

    /**
     * @var \DateTime
     */
    private $fechacreacion;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $inmunizacion;

    /**
     * @var \Asi\ClinicaBundle\Entity\Municipio
     */
    private $idmunicipio;

    /**
     * @var \Asi\ClinicaBundle\Entity\User
     */
    private $idusuario;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $encargadopaciente;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $pacientepatologia;

    /**
     * @var \Asi\ClinicaBundle\Entity\User
     */
    private $pednacimientodesarrollo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inmunizacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->encargadopaciente = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pacientepatologia = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set dui
     *
     * @param string $dui
     * @return Paciente
     */
    public function setDui($dui)
    {
        $this->dui = $dui;
    
        return $this;
    }

    /**
     * Get dui
     *
     * @return string 
     */
    public function getDui()
    {
        return $this->dui;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     * @return Paciente
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    
        return $this;
    }

    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Paciente
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    
        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set genero
     *
     * @param string $genero
     * @return Paciente
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    
        return $this;
    }

    /**
     * Get genero
     *
     * @return string 
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set fechanacimiento
     *
     * @param \DateTime $fechanacimiento
     * @return Paciente
     */
    public function setFechanacimiento($fechanacimiento)
    {
        $this->fechanacimiento = $fechanacimiento;
    
        return $this;
    }

    /**
     * Get fechanacimiento
     *
     * @return \DateTime 
     */
    public function getFechanacimiento()
    {
        return $this->fechanacimiento;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Paciente
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set movil
     *
     * @param string $movil
     * @return Paciente
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;
    
        return $this;
    }

    /**
     * Get movil
     *
     * @return string 
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set referidopor
     *
     * @param string $referidopor
     * @return Paciente
     */
    public function setReferidopor($referidopor)
    {
        $this->referidopor = $referidopor;
    
        return $this;
    }

    /**
     * Get referidopor
     *
     * @return string 
     */
    public function getReferidopor()
    {
        return $this->referidopor;
    }

    /**
     * Set lugarnacimiento
     *
     * @param string $lugarnacimiento
     * @return Paciente
     */
    public function setLugarnacimiento($lugarnacimiento)
    {
        $this->lugarnacimiento = $lugarnacimiento;
    
        return $this;
    }

    /**
     * Get lugarnacimiento
     *
     * @return string 
     */
    public function getLugarnacimiento()
    {
        return $this->lugarnacimiento;
    }

    /**
     * Set fechacreacion
     *
     * @param \DateTime $fechacreacion
     * @return Paciente
     */
    public function setFechacreacion($fechacreacion)
    {
        $this->fechacreacion = $fechacreacion;
    
        return $this;
    }

    /**
     * Get fechacreacion
     *
     * @return \DateTime 
     */
    public function getFechacreacion()
    {
        return $this->fechacreacion;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Paciente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Add inmunizacion
     *
     * @param \Asi\ClinicaBundle\Entity\Inmunizacion $inmunizacion
     * @return Paciente
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
     * Set idmunicipio
     *
     * @param \Asi\ClinicaBundle\Entity\Municipio $idmunicipio
     * @return Paciente
     */
    public function setIdmunicipio(\Asi\ClinicaBundle\Entity\Municipio $idmunicipio = null)
    {
        $this->idmunicipio = $idmunicipio;
    
        return $this;
    }

    /**
     * Get idmunicipio
     *
     * @return \Asi\ClinicaBundle\Entity\Municipio 
     */
    public function getIdmunicipio()
    {
        return $this->idmunicipio;
    }

    /**
     * Set idusuario
     *
     * @param \Asi\ClinicaBundle\Entity\Usuario $idusuario
     * @return Paciente
     */
    public function setIdusuario(\Asi\ClinicaBundle\Entity\User $idusuario = null)
    {
        $this->idusuario = $idusuario;
    
        return $this;
    }

    /**
     * Get idusuario
     *
     * @return \Asi\ClinicaBundle\Entity\User 
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }
    
    public function getNombreApellido(){
        return sprintf('%s %s', $this->nombres, $this->apellidos);
    }   

    public function getIdNombreApellido()
    {
        return sprintf('%s - %s %s', $this->id, $this->nombres, $this->apellidos);
    }

    public function getEdad()
    {
        $fecha = new \DateTime('now');
        return $fecha->diff($this->fechanacimiento)->y;
    }

    /**
     * Add encargadopaciente
     *
     * @param \Asi\ClinicaBundle\Entity\Encargadopaciente $encargadopaciente
     * @return Paciente
     */
    public function addEncargadopaciente(\Asi\ClinicaBundle\Entity\Encargadopaciente $encargadopaciente)
    {
        $this->encargadopaciente[] = $encargadopaciente;
    
        return $this;
    }

    /**
     * Remove encargadopaciente
     *
     * @param \Asi\ClinicaBundle\Entity\Encargadopaciente $encargadopaciente
     */
    public function removeEncargadopaciente(\Asi\ClinicaBundle\Entity\Encargadopaciente $encargadopaciente)
    {
        $this->encargadopaciente->removeElement($encargadopaciente);
    }

    /**
     * Get encargadopaciente
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEncargadopaciente()
    {
        return $this->encargadopaciente;
    }

    /**
     * Add pacientepatologia
     *
     * @param \Asi\ClinicaBundle\Entity\Pacientepatologia $pacientepatologia
     * @return Paciente
     */
    public function addPacientepatologia(\Asi\ClinicaBundle\Entity\Pacientepatologia $pacientepatologia)
    {
        $this->pacientepatologia[] = $pacientepatologia;
    
        return $this;
    }

    /**
     * Remove pacientepatologia
     *
     * @param \Asi\ClinicaBundle\Entity\Pacientepatologia $pacientepatologia
     */
    public function removePacientepatologia(\Asi\ClinicaBundle\Entity\Pacientepatologia $pacientepatologia)
    {
        $this->pacientepatologia->removeElement($pacientepatologia);
    }

    /**
     * Get pacientepatologia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPacientepatologia()
    {
        return $this->pacientepatologia;
    }

    /**
     * Get pednacimientodesarrollo
     *
     * @return \Asi\ClinicaBundle\Entity\Pednacimientodesarrollo $pednacimientodesarrollo
     */
    public function getPednacimientodesarrollo()
    {
        return $this->pednacimientodesarrollo;
    }
}
