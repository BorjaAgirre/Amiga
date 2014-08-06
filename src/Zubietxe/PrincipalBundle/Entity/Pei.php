<?php

namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pei
 *
 * @ORM\Table(name="pei", indexes={@ORM\Index(name="id_unico", columns={"id_unico"})})
 * @ORM\Entity
 */
class Pei
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_pei", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPei;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_pei_unico", type="integer", nullable=true)
     */
    private $idPeiUnico;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="dimension", type="integer", nullable=true)
     */
    private $dimension;

    /**
     * @var integer
     *
     * @ORM\Column(name="objetivo", type="integer", nullable=true)
     */
    private $objetivo;

    /**
     * @var string
     *
     * @ORM\Column(name="meta", type="string", length=255, nullable=true)
     */
    private $meta;

    /**
     * @var integer
     *
     * @ORM\Column(name="accion", type="integer", nullable=true)
     */
    private $accion;

    /**
     * @var string
     *
     * @ORM\Column(name="tarea", type="string", length=255, nullable=true)
     */
    private $tarea;

    /**
     * @var string
     *
     * @ORM\Column(name="recurso", type="string", length=255, nullable=true)
     */
    private $recurso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ini", type="date", nullable=true)
     */
    private $fechaIni;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=true)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado", type="string", length=255, nullable=true)
     */
    private $resultado;

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
     * Get idPei
     *
     * @return integer 
     */
    public function getIdPei()
    {
        return $this->idPei;
    }

    /**
     * Set idPeiUnico
     *
     * @param integer $idPeiUnico
     * @return Pei
     */
    public function setIdPeiUnico($idPeiUnico)
    {
        $this->idPeiUnico = $idPeiUnico;

        return $this;
    }

    /**
     * Get idPeiUnico
     *
     * @return integer 
     */
    public function getIdPeiUnico()
    {
        return $this->idPeiUnico;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Pei
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set dimension
     *
     * @param integer $dimension
     * @return Pei
     */
    public function setDimension($dimension)
    {
        $this->dimension = $dimension;

        return $this;
    }

    /**
     * Get dimension
     *
     * @return integer 
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * Set objetivo
     *
     * @param integer $objetivo
     * @return Pei
     */
    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;

        return $this;
    }

    /**
     * Get objetivo
     *
     * @return integer 
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Set meta
     *
     * @param string $meta
     * @return Pei
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Get meta
     *
     * @return string 
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set accion
     *
     * @param integer $accion
     * @return Pei
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;

        return $this;
    }

    /**
     * Get accion
     *
     * @return integer 
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set tarea
     *
     * @param string $tarea
     * @return Pei
     */
    public function setTarea($tarea)
    {
        $this->tarea = $tarea;

        return $this;
    }

    /**
     * Get tarea
     *
     * @return string 
     */
    public function getTarea()
    {
        return $this->tarea;
    }

    /**
     * Set recurso
     *
     * @param string $recurso
     * @return Pei
     */
    public function setRecurso($recurso)
    {
        $this->recurso = $recurso;

        return $this;
    }

    /**
     * Get recurso
     *
     * @return string 
     */
    public function getRecurso()
    {
        return $this->recurso;
    }

    /**
     * Set fechaIni
     *
     * @param \DateTime $fechaIni
     * @return Pei
     */
    public function setFechaIni($fechaIni)
    {
        $this->fechaIni = $fechaIni;

        return $this;
    }

    /**
     * Get fechaIni
     *
     * @return \DateTime 
     */
    public function getFechaIni()
    {
        return $this->fechaIni;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return Pei
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     * @return Pei
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set resultado
     *
     * @param string $resultado
     * @return Pei
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;

        return $this;
    }

    /**
     * Get resultado
     *
     * @return string 
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set idUnico
     *
     * @param \Zubietxe\PrincipalBundle\Entity\Persona $idUnico
     * @return Pei
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
}
