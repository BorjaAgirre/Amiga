<?php

namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AltaBaja
 *
 * @ORM\Table(name="alta_baja", indexes={@ORM\Index(name="id_unico", columns={"id_unico"}), @ORM\Index(name="serv", columns={"serv"})})
 * @ORM\Entity
 */
class AltaBaja
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_altabaja", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAltabaja;

    /**
     * @var string
     *
     * @ORM\Column(name="servicio", type="string", length=20, nullable=true)
     */
    private $servicio;

    /**
     * @var string
     *
     * @ORM\Column(name="alta_baja", type="string", length=1, nullable=true)
     */
    private $altaBaja;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_correl", type="date", nullable=true)
     */
    private $fechaCorrel;

    /**
     * @var integer
     *
     * @ORM\Column(name="motivo_baja", type="integer", nullable=true)
     */
    private $motivoBaja;

    /**
     * @var integer
     *
     * @ORM\Column(name="autor_inserc", type="integer", nullable=true)
     */
    private $autorInserc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inserc", type="datetime", nullable=true)
     */
    private $fechaInserc;

    /**
     * @var \Zubietxe\PrincipalBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="Zubietxe\PrincipalBundle\Entity\Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_unico", referencedColumnName="id_unico")
     * })
     */
    private $idUnico;

    /**
     * @var \Zubietxe\PrincipalBundle\Entity\Servicios
     *
     * @ORM\ManyToOne(targetEntity="Zubietxe\PrincipalBundle\Entity\Servicios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="serv", referencedColumnName="id_servicio")
     * })
     */
    private $serv;



    /**
     * Get idAltabaja
     *
     * @return integer 
     */
    public function getIdAltabaja()
    {
        return $this->idAltabaja;
    }

    /**
     * Set servicio
     *
     * @param string $servicio
     * @return AltaBaja
     */
    public function setServicio($servicio)
    {
        $this->servicio = $servicio;

        return $this;
    }

    /**
     * Get servicio
     *
     * @return string 
     */
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     * Set altaBaja
     *
     * @param string $altaBaja
     * @return AltaBaja
     */
    public function setAltaBaja($altaBaja)
    {
        $this->altaBaja = $altaBaja;

        return $this;
    }

    /**
     * Get altaBaja
     *
     * @return string 
     */
    public function getAltaBaja()
    {
        return $this->altaBaja;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return AltaBaja
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set fechaCorrel
     *
     * @param \DateTime $fechaCorrel
     * @return AltaBaja
     */
    public function setFechaCorrel($fechaCorrel)
    {
        $this->fechaCorrel = $fechaCorrel;

        return $this;
    }

    /**
     * Get fechaCorrel
     *
     * @return \DateTime 
     */
    public function getFechaCorrel()
    {
        return $this->fechaCorrel;
    }

    /**
     * Set motivoBaja
     *
     * @param integer $motivoBaja
     * @return AltaBaja
     */
    public function setMotivoBaja($motivoBaja)
    {
        $this->motivoBaja = $motivoBaja;

        return $this;
    }

    /**
     * Get motivoBaja
     *
     * @return integer 
     */
    public function getMotivoBaja()
    {
        return $this->motivoBaja;
    }

    /**
     * Set autorInserc
     *
     * @param integer $autorInserc
     * @return AltaBaja
     */
    public function setAutorInserc($autorInserc)
    {
        $this->autorInserc = $autorInserc;

        return $this;
    }

    /**
     * Get autorInserc
     *
     * @return integer 
     */
    public function getAutorInserc()
    {
        return $this->autorInserc;
    }

    /**
     * Set fechaInserc
     *
     * @param \DateTime $fechaInserc
     * @return AltaBaja
     */
    public function setFechaInserc($fechaInserc)
    {
        $this->fechaInserc = $fechaInserc;

        return $this;
    }

    /**
     * Get fechaInserc
     *
     * @return \DateTime 
     */
    public function getFechaInserc()
    {
        return $this->fechaInserc;
    }

    /**
     * Set idUnico
     *
     * @param \Zubietxe\PrincipalBundle\Entity\Persona $idUnico
     * @return AltaBaja
     */
    public function setIdUnico(\Zubietxe\PrincipalBundle\Entity\Persona $idUnico = null)
    {
        $this->idUnico = $idUnico;

        return $this;
    }

    /**
     * Get idUnico
     *
     * @return \Zubietxe\PrincipalBundle\Entity\Persona 
     */
    public function getIdUnico()
    {
        return $this->idUnico;
    }

    /**
     * Set serv
     *
     * @param \Zubietxe\PrincipalBundle\Entity\Servicios $serv
     * @return AltaBaja
     */
    public function setServ(\Zubietxe\PrincipalBundle\Entity\Servicios $serv = null)
    {
        $this->serv = $serv;

        return $this;
    }

    /**
     * Get serv
     *
     * @return \Zubietxe\PrincipalBundle\Entity\Servicios 
     */
    public function getServ()
    {
        return $this->serv;
    }
}
