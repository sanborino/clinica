<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Encargado
 */
class Encargado
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
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $movil;

    /**
     * @var \DateTime
     */
    private $fechanacimiento;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var boolean
     */
    private $estadoactivacion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $encargadopaciente;

    /**
     * @var \Asi\ClinicaBundle\Entity\Municipio
     */
    private $idmunicipio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->encargadopaciente = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Encargado
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
     * @return Encargado
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
     * Set telefono
     *
     * @param string $telefono
     * @return Encargado
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
     * @return Encargado
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
     * Set fechanacimiento
     *
     * @param \DateTime $fechanacimiento
     * @return Encargado
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
     * Set direccion
     *
     * @param string $direccion
     * @return Encargado
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
     * Set estadoactivacion
     *
     * @param boolean $estadoactivacion
     * @return Encargado
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
     * Add encargadopaciente
     *
     * @param \Asi\ClinicaBundle\Entity\Encargadopaciente $encargadopaciente
     * @return Encargado
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
     * Set idmunicipio
     *
     * @param \Asi\ClinicaBundle\Entity\Municipio $idmunicipio
     * @return Encargado
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
    
    public function getNombreApellido()
    {
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
}
