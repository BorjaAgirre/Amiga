<?php

namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actividad
 *
 * @ORM\Table(name="actividad", indexes={@ORM\Index(name="tipo_activ", columns={"tipo_activ"}), @ORM\Index(name="responsable", columns={"responsable"})})
 * @ORM\Entity
 */
class Actividad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="responsable2", type="integer", nullable=true)
     */
    private $responsable2;

    /**
     * @var string
     *
     * @ORM\Column(name="volunt", type="string", length=40, nullable=true)
     */
    private $volunt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actividad", type="date", nullable=true)
     */
    private $fechaActividad;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario_actividad", type="string", length=255, nullable=true)
     */
    private $comentarioActividad;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_actividad", type="string", length=255, nullable=true)
     */
    private $observacionesActividad;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_activ", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idActiv;

    /**
     * @var \Zubietxe\PrincipalBundle\Entity\Tutor
     *
     * @ORM\ManyToOne(targetEntity="Zubietxe\PrincipalBundle\Entity\Tutor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="responsable", referencedColumnName="id_tutor")
     * })
     */
    private $responsable;

    /**
     * @var \Zubietxe\PrincipalBundle\Entity\ListaActividades
     *
     * @ORM\ManyToOne(targetEntity="Zubietxe\PrincipalBundle\Entity\ListaActividades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_activ", referencedColumnName="id_listaactividad")
     * })
     */
    private $tipoActiv;



    /**
     * Set responsable2
     *
     * @param integer $responsable2
     * @return Actividad
     */
    public function setResponsable2($responsable2)
    {
        $this->responsable2 = $responsable2;

        return $this;
    }

    /**
     * Get responsable2
     *
     * @return integer 
     */
    public function getResponsable2()
    {
        return $this->responsable2;
    }

    /**
     * Set volunt
     *
     * @param string $volunt
     * @return Actividad
     */
    public function setVolunt($volunt)
    {
        $this->volunt = $volunt;

        return $this;
    }

    /**
     * Get volunt
     *
     * @return string 
     */
    public function getVolunt()
    {
        return $this->volunt;
    }

    /**
     * Set fechaActividad
     *
     * @param \DateTime $fechaActividad
     * @return Actividad
     */
    public function setFechaActividad($fechaActividad)
    {
        $this->fechaActividad = $fechaActividad;

        return $this;
    }

    /**
     * Get fechaActividad
     *
     * @return \DateTime 
     */
    public function getFechaActividad()
    {
        return $this->fechaActividad;
    }

    /**
     * Set comentarioActividad
     *
     * @param string $comentarioActividad
     * @return Actividad
     */
    public function setComentarioActividad($comentarioActividad)
    {
        $this->comentarioActividad = $comentarioActividad;

        return $this;
    }

    /**
     * Get comentarioActividad
     *
     * @return string 
     */
    public function getComentarioActividad()
    {
        return $this->comentarioActividad;
    }

    /**
     * Set observacionesActividad
     *
     * @param string $observacionesActividad
     * @return Actividad
     */
    public function setObservacionesActividad($observacionesActividad)
    {
        $this->observacionesActividad = $observacionesActividad;

        return $this;
    }

    /**
     * Get observacionesActividad
     *
     * @return string 
     */
    public function getObservacionesActividad()
    {
        return $this->observacionesActividad;
    }

    /**
     * Get idActiv
     *
     * @return integer 
     */
    public function getIdActiv()
    {
        return $this->idActiv;
    }

    /**
     * Set responsable
     *
     * @param \Zubietxe\PrincipalBundle\Entity\Tutor $responsable
     * @return Actividad
     */
    public function setResponsable(\Zubietxe\PrincipalBundle\Entity\Tutor $responsable = null)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return \Zubietxe\PrincipalBundle\Entity\Tutor 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set tipoActiv
     *
     * @param \Zubietxe\PrincipalBundle\Entity\ListaActividades $tipoActiv
     * @return Actividad
     */
    public function setTipoActiv(\Zubietxe\PrincipalBundle\Entity\ListaActividades $tipoActiv = null)
    {
        $this->tipoActiv = $tipoActiv;

        return $this;
    }

    /**
     * Get tipoActiv
     *
     * @return \Zubietxe\PrincipalBundle\Entity\ListaActividades 
     */
    public function getTipoActiv()
    {
        return $this->tipoActiv;
    }
}
