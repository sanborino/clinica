<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaAcceso
 */
class PantallaAcceso
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Asi\ClinicaBundle\Entity\Pantalla
     */
    private $pantalla;

    /**
     * @var \Asi\ClinicaBundle\Entity\Tipousuario
     */
    private $tipoUsuario;

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
     * Set pantalla
     *
     * @param \Asi\ClinicaBundle\Entity\Pantalla $pantalla
     * @return Pantalla
     */
    public function setPantalla(\Asi\ClinicaBundle\Entity\Pantalla $pantalla = null)
    {
        $this->pantalla = $pantalla;
    
        return $this;
    }

    /**
     * Get pantalla
     *
     * @return \Asi\ClinicaBundle\Entity\Pantalla 
     */
    public function getPantalla()
    {
        return $this->pantalla;
    }

    /**
     * Set tipoUsuario
     *
     * @param \Asi\ClinicaBundle\Entity\Tipousuario $tipoUsuario
     * @return Tipousuario
     */
    public function setTipoUsuario(\Asi\ClinicaBundle\Entity\Tipousuario $tipoUsuario = null)
    {
        $this->tipoUsuario = $tipoUsuario;
    
        return $this;
    }

    /**
     * Get tipoUsuario
     *
     * @return \Asi\ClinicaBundle\Entity\Tipousuario 
     */
    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }
    
}
