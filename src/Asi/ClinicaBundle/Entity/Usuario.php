<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 */
class Usuario
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $password;

    /**
     * @var boolean
     */
    private $estadoactivacion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $paciente;

    /**
     * @var \Asi\ClinicaBundle\Entity\Tipousuario
     */
    private $idtipousuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->paciente = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set estadoactivacion
     *
     * @param boolean $estadoactivacion
     * @return Usuario
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
     * Add paciente
     *
     * @param \Asi\ClinicaBundle\Entity\Paciente $paciente
     * @return Usuario
     */
    public function addPaciente(\Asi\ClinicaBundle\Entity\Paciente $paciente)
    {
        $this->paciente[] = $paciente;
    
        return $this;
    }

    /**
     * Remove paciente
     *
     * @param \Asi\ClinicaBundle\Entity\Paciente $paciente
     */
    public function removePaciente(\Asi\ClinicaBundle\Entity\Paciente $paciente)
    {
        $this->paciente->removeElement($paciente);
    }

    /**
     * Get paciente
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set idtipousuario
     *
     * @param \Asi\ClinicaBundle\Entity\Tipousuario $idtipousuario
     * @return Usuario
     */
    public function setIdtipousuario(\Asi\ClinicaBundle\Entity\Tipousuario $idtipousuario = null)
    {
        $this->idtipousuario = $idtipousuario;
    
        return $this;
    }

    /**
     * Get idtipousuario
     *
     * @return \Asi\ClinicaBundle\Entity\Tipousuario 
     */
    public function getIdtipousuario()
    {
        return $this->idtipousuario;
    }
    
}
