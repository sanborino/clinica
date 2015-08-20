<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Itemespecialidad
 */
class Itemespecialidad
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Asi\ClinicaBundle\Entity\Especialidad
     */
    private $idespecialidad;

    /**
     * @var \Asi\ClinicaBundle\Entity\Itemexamenfisico
     */
    private $iditemexamenfisico;


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
     * Set idespecialidad
     *
     * @param \Asi\ClinicaBundle\Entity\Especialidad $idespecialidad
     * @return Itemespecialidad
     */
    public function setIdespecialidad(\Asi\ClinicaBundle\Entity\Especialidad $idespecialidad = null)
    {
        $this->idespecialidad = $idespecialidad;
    
        return $this;
    }

    /**
     * Get idespecialidad
     *
     * @return \Asi\ClinicaBundle\Entity\Especialidad 
     */
    public function getIdespecialidad()
    {
        return $this->idespecialidad;
    }

    /**
     * Set iditemexamenfisico
     *
     * @param \Asi\ClinicaBundle\Entity\Itemexamenfisico $iditemexamenfisico
     * @return Itemespecialidad
     */
    public function setIditemexamenfisico(\Asi\ClinicaBundle\Entity\Itemexamenfisico $iditemexamenfisico = null)
    {
        $this->iditemexamenfisico = $iditemexamenfisico;
    
        return $this;
    }

    /**
     * Get iditemexamenfisico
     *
     * @return \Asi\ClinicaBundle\Entity\Itemexamenfisico 
     */
    public function getIditemexamenfisico()
    {
        return $this->iditemexamenfisico;
    }
}
