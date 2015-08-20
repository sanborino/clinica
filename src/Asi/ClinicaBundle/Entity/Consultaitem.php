<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consultaitem
 */
class Consultaitem
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $valor;

    /**
     * @var \Asi\ClinicaBundle\Entity\Consulta
     */
    private $idconsulta;

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
     * Set valor
     *
     * @param string $valor
     * @return Consultaitem
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set idconsulta
     *
     * @param \Asi\ClinicaBundle\Entity\Consulta $idconsulta
     * @return Consultaitem
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
     * Set iditemexamenfisico
     *
     * @param \Asi\ClinicaBundle\Entity\Itemexamenfisico $iditemexamenfisico
     * @return Consultaitem
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

    public function getValorString()
    {
        $valor = $this->valor;
        if ($this->iditemexamenfisico->getTipodato()==='checkbox') {
            $valor = 'No';
            if ($this->valor = '1') {
                $valor = 'Si';
            }
        }

        return $valor;
    }
}
