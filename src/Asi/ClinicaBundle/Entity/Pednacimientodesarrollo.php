<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pednacimientodesarrollo
 */
class Pednacimientodesarrollo
{
    /**
     * @var string
     */
    private $edadgestacional;

    /**
     * @var string
     */
    private $condicionnacimiento;

    /**
     * @var string
     */
    private $cianosis;

    /**
     * @var string
     */
    private $convulsiones;

    /**
     * @var string
     */
    private $ictericia;

    /**
     * @var string
     */
    private $partocomentario;

    /**
     * @var string
     */
    private $pesonacimiento;

    /**
     * @var string
     */
    private $alimentacion;

    /**
     * @var string
     */
    private $sesento;

    /**
     * @var string
     */
    private $camino;

    /**
     * @var string
     */
    private $separo;

    /**
     * @var string
     */
    private $primeraspalabras;

    /**
     * @var string
     */
    private $primerdiente;

    /**
     * @var string
     */
    private $frasescortas;

    /**
     * @var string
     */
    private $controlvesical;

    /**
     * @var string
     */
    private $controlintestinal;

    /**
     * @var string
     */
    private $obstetra;

    /**
     * @var \Asi\ClinicaBundle\Entity\Paciente
     */
    private $idpaciente;


    /**
     * Set edadgestacional
     *
     * @param string $edadgestacional
     * @return Pednacimientodesarrollo
     */
    public function setEdadgestacional($edadgestacional)
    {
        $this->edadgestacional = $edadgestacional;
    
        return $this;
    }

    /**
     * Get edadgestacional
     *
     * @return string 
     */
    public function getEdadgestacional()
    {
        return $this->edadgestacional;
    }

    /**
     * Set condicionnacimiento
     *
     * @param string $condicionnacimiento
     * @return Pednacimientodesarrollo
     */
    public function setCondicionnacimiento($condicionnacimiento)
    {
        $this->condicionnacimiento = $condicionnacimiento;
    
        return $this;
    }

    /**
     * Get condicionnacimiento
     *
     * @return string 
     */
    public function getCondicionnacimiento()
    {
        return $this->condicionnacimiento;
    }

    /**
     * Set cianosis
     *
     * @param string $cianosis
     * @return Pednacimientodesarrollo
     */
    public function setCianosis($cianosis)
    {
        $this->cianosis = $cianosis;
    
        return $this;
    }

    /**
     * Get cianosis
     *
     * @return string 
     */
    public function getCianosis()
    {
        return $this->cianosis;
    }

    /**
     * Set convulsiones
     *
     * @param string $convulsiones
     * @return Pednacimientodesarrollo
     */
    public function setConvulsiones($convulsiones)
    {
        $this->convulsiones = $convulsiones;
    
        return $this;
    }

    /**
     * Get convulsiones
     *
     * @return string 
     */
    public function getConvulsiones()
    {
        return $this->convulsiones;
    }

    /**
     * Set ictericia
     *
     * @param string $ictericia
     * @return Pednacimientodesarrollo
     */
    public function setIctericia($ictericia)
    {
        $this->ictericia = $ictericia;
    
        return $this;
    }

    /**
     * Get ictericia
     *
     * @return string 
     */
    public function getIctericia()
    {
        return $this->ictericia;
    }

    /**
     * Set partocomentario
     *
     * @param string $partocomentario
     * @return Pednacimientodesarrollo
     */
    public function setPartocomentario($partocomentario)
    {
        $this->partocomentario = $partocomentario;
    
        return $this;
    }

    /**
     * Get partocomentario
     *
     * @return string 
     */
    public function getPartocomentario()
    {
        return $this->partocomentario;
    }

    /**
     * Set pesonacimiento
     *
     * @param string $pesonacimiento
     * @return Pednacimientodesarrollo
     */
    public function setPesonacimiento($pesonacimiento)
    {
        $this->pesonacimiento = $pesonacimiento;
    
        return $this;
    }

    /**
     * Get pesonacimiento
     *
     * @return string 
     */
    public function getPesonacimiento()
    {
        return $this->pesonacimiento;
    }

    /**
     * Set alimentacion
     *
     * @param string $alimentacion
     * @return Pednacimientodesarrollo
     */
    public function setAlimentacion($alimentacion)
    {
        $this->alimentacion = $alimentacion;
    
        return $this;
    }

    /**
     * Get alimentacion
     *
     * @return string 
     */
    public function getAlimentacion()
    {
        return $this->alimentacion;
    }

    /**
     * Set sesento
     *
     * @param string $sesento
     * @return Pednacimientodesarrollo
     */
    public function setSesento($sesento)
    {
        $this->sesento = $sesento;
    
        return $this;
    }

    /**
     * Get sesento
     *
     * @return string 
     */
    public function getSesento()
    {
        return $this->sesento;
    }

    /**
     * Set camino
     *
     * @param string $camino
     * @return Pednacimientodesarrollo
     */
    public function setCamino($camino)
    {
        $this->camino = $camino;
    
        return $this;
    }

    /**
     * Get camino
     *
     * @return string 
     */
    public function getCamino()
    {
        return $this->camino;
    }

    /**
     * Set separo
     *
     * @param string $separo
     * @return Pednacimientodesarrollo
     */
    public function setSeparo($separo)
    {
        $this->separo = $separo;
    
        return $this;
    }

    /**
     * Get separo
     *
     * @return string 
     */
    public function getSeparo()
    {
        return $this->separo;
    }

    /**
     * Set primeraspalabras
     *
     * @param string $primeraspalabras
     * @return Pednacimientodesarrollo
     */
    public function setPrimeraspalabras($primeraspalabras)
    {
        $this->primeraspalabras = $primeraspalabras;
    
        return $this;
    }

    /**
     * Get primeraspalabras
     *
     * @return string 
     */
    public function getPrimeraspalabras()
    {
        return $this->primeraspalabras;
    }

    /**
     * Set primerdiente
     *
     * @param string $primerdiente
     * @return Pednacimientodesarrollo
     */
    public function setPrimerdiente($primerdiente)
    {
        $this->primerdiente = $primerdiente;
    
        return $this;
    }

    /**
     * Get primerdiente
     *
     * @return string 
     */
    public function getPrimerdiente()
    {
        return $this->primerdiente;
    }

    /**
     * Set frasescortas
     *
     * @param string $frasescortas
     * @return Pednacimientodesarrollo
     */
    public function setFrasescortas($frasescortas)
    {
        $this->frasescortas = $frasescortas;
    
        return $this;
    }

    /**
     * Get frasescortas
     *
     * @return string 
     */
    public function getFrasescortas()
    {
        return $this->frasescortas;
    }

    /**
     * Set controlvesical
     *
     * @param string $controlvesical
     * @return Pednacimientodesarrollo
     */
    public function setControlvesical($controlvesical)
    {
        $this->controlvesical = $controlvesical;
    
        return $this;
    }

    /**
     * Get controlvesical
     *
     * @return string 
     */
    public function getControlvesical()
    {
        return $this->controlvesical;
    }

    /**
     * Set controlintestinal
     *
     * @param string $controlintestinal
     * @return Pednacimientodesarrollo
     */
    public function setControlintestinal($controlintestinal)
    {
        $this->controlintestinal = $controlintestinal;
    
        return $this;
    }

    /**
     * Get controlintestinal
     *
     * @return string 
     */
    public function getControlintestinal()
    {
        return $this->controlintestinal;
    }

    /**
     * Set obstetra
     *
     * @param string $obstetra
     * @return Pednacimientodesarrollo
     */
    public function setObstetra($obstetra)
    {
        $this->obstetra = $obstetra;
    
        return $this;
    }

    /**
     * Get obstetra
     *
     * @return string 
     */
    public function getObstetra()
    {
        return $this->obstetra;
    }

    /**
     * Set idpaciente
     *
     * @param \Asi\ClinicaBundle\Entity\Paciente $idpaciente
     * @return Pednacimientodesarrollo
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
     * @var integer
     */
    private $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
