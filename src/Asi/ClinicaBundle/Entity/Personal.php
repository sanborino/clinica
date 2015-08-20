<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Personal
 */
class Personal
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

        if ($this->getFechanacimiento()->diff(new \DateTime('today'))->y < 18 ) {
            $context->buildViolation('Debe ser mayor de 18 años.')
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
    private $nombres;

    /**
     * @var string
     */
    private $apellidos;

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
    private $dui;

    /**
     * @var string
     */
    private $movil;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $genero;

    /**
     * @var boolean
     */
    private $estadoactivacion;

    /**
     * @var \Asi\ClinicaBundle\Entity\Municipio
     */
    private $idmunicipio;

    /**
     * @var \Asi\ClinicaBundle\Entity\Tipopersonal
     */
    private $idtipopersonal;

    /**
     * @var \Asi\ClinicaBundle\Entity\User
     */
    private $idusuario;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $personalclinica;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personalclinica = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estadoactivacion = true;
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
     * Set nombres
     *
     * @param string $nombres
     * @return Personal
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
     * @return Personal
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
     * Set fechanacimiento
     *
     * @param \DateTime $fechanacimiento
     * @return Personal
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
     * @return Personal
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
     * Set dui
     *
     * @param string $dui
     * @return Personal
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
     * Set movil
     *
     * @param string $movil
     * @return Personal
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
     * Set direccion
     *
     * @param string $direccion
     * @return Personal
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
     * Set genero
     *
     * @param string $genero
     * @return Personal
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
     * Set estadoactivacion
     *
     * @param boolean $estadoactivacion
     * @return Personal
     */
    public function setEstadoactivacion($estadoactivacion)
    {
        $this->estadoactivacion = $estadoactivacion;
    
        return $this;
    }

    /**
     * Get estadoactivacion
     *
     * @return boolean 
     */
    public function getEstadoactivacion()
    {
        return $this->estadoactivacion;
    }

    public function getEstadoActivacionString()
    {
        if ($this->estadoactivacion==1) {
            return 'Si';
        } else {
            return 'No';
        }
    }

    /**
     * Set idmunicipio
     *
     * @param \Asi\ClinicaBundle\Entity\Municipio $idmunicipio
     * @return Personal
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
     * Set idtipopersonal
     *
     * @param \Asi\ClinicaBundle\Entity\Tipopersonal $idtipopersonal
     * @return Personal
     */
    public function setIdtipopersonal(\Asi\ClinicaBundle\Entity\Tipopersonal $idtipopersonal = null)
    {
        $this->idtipopersonal = $idtipopersonal;
    
        return $this;
    }

    /**
     * Get idtipopersonal
     *
     * @return \Asi\ClinicaBundle\Entity\Tipopersonal 
     */
    public function getIdtipopersonal()
    {
        return $this->idtipopersonal;
    }

    /**
     * Set idusuario
     *
     * @param \Asi\ClinicaBundle\Entity\User $idusuario
     * @return Personal
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

    /**
     * Add personalclinica
     *
     * @param \Asi\ClinicaBundle\Entity\Personalclinica $personalclinica
     * @return Personal
     */
    public function addPersonalclinica(\Asi\ClinicaBundle\Entity\Personalclinica $personalclinica)
    {
        $this->personalclinica[] = $personalclinica;
    
        return $this;
    }

    /**
     * Remove personalclinica
     *
     * @param \Asi\ClinicaBundle\Entity\Personalclinica $personalclinica
     */
    public function removePersonalclinica(\Asi\ClinicaBundle\Entity\Personalclinica $personalclinica)
    {
        $this->personalclinica->removeElement($personalclinica);
    }

    /**
     * Get personalclinica
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersonalclinica()
    {
        return $this->personalclinica;
    }

    public function getEdad()
    {
        $fecha = new \DateTime('now');
        return $fecha->diff($this->fechanacimiento)->y;
    }
    
    public function getNombreApellido()
    {
        return sprintf('%s %s', $this->nombres, $this->apellidos);
    }
}
