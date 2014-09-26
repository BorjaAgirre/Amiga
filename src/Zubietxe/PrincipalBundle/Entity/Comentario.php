<?php

namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comentario
 *
 * @ORM\Table(name="comentario", indexes={@ORM\Index(name="id_pers", columns={"id_unico"}), @ORM\Index(name="id_actividad", columns={"id_actividad"}), @ORM\Index(name="hito", columns={"hito"})})
 * @ORM\Entity
 */
class Comentario
{
    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="text", nullable=true)
     */
    private $comentario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="tutor", type="integer", nullable=true)
     */
    private $tutor;

    /**
     * @var integer
     *
     * @ORM\Column(name="grupo", type="integer", nullable=true)
     */
    private $grupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="permisos", type="integer", nullable=true)
     */
    private $permisos;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_comentario", type="string", length=1, nullable=true)
     */
    private $tipoComentario;

    /**
     * @var integer
     *
     * @ORM\Column(name="hito_activ", type="integer", nullable=true)
     */
    private $hitoActiv;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_coment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idComent;

    /**
     * @var \Zubietxe\PrincipalBundle\Entity\Hito
     *
     * @ORM\ManyToOne(targetEntity="Zubietxe\PrincipalBundle\Entity\Hito")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="hito", referencedColumnName="id_hito")
     * })
     */
    private $hito;

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
     * @var \Zubietxe\PrincipalBundle\Entity\Actividad
     *
     * @ORM\ManyToOne(targetEntity="Zubietxe\PrincipalBundle\Entity\Actividad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_actividad", referencedColumnName="id_activ")
     * })
     */
    private $idActividad;



    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Comentario
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
     * Set tutor
     *
     * @param integer $tutor
     * @return Comentario
     */
    public function setTutor($tutor)
    {
        $this->tutor = $tutor;

        return $this;
    }

    /**
     * Get tutor
     *
     * @return integer 
     */
    public function getTutor()
    {
        return $this->tutor;
    }

    /**
     * Set grupo
     *
     * @param integer $grupo
     * @return Comentario
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return integer 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set permisos
     *
     * @param integer $permisos
     * @return Comentario
     */
    public function setPermisos($permisos)
    {
        $this->permisos = $permisos;

        return $this;
    }

    /**
     * Get permisos
     *
     * @return integer 
     */
    public function getPermisos()
    {
        return $this->permisos;
    }

    /**
     * Set tipoComentario
     *
     * @param string $tipoComentario
     * @return Comentario
     */
    public function setTipoComentario($tipoComentario)
    {
        $this->tipoComentario = $tipoComentario;

        return $this;
    }

    /**
     * Get tipoComentario
     *
     * @return string 
     */
    public function getTipoComentario()
    {
        return $this->tipoComentario;
    }

    /**
     * Set hitoActiv
     *
     * @param integer $hitoActiv
     * @return Comentario
     */
    public function setHitoActiv($hitoActiv)
    {
        $this->hitoActiv = $hitoActiv;

        return $this;
    }

    /**
     * Get hitoActiv
     *
     * @return integer 
     */
    public function getHitoActiv()
    {
        return $this->hitoActiv;
    }

    /**
     * Get idComent
     *
     * @return integer 
     */
    public function getIdComent()
    {
        return $this->idComent;
    }

    /**
     * Set hito
     *
     * @param \Zubietxe\PrincipalBundle\Entity\Hito $hito
     * @return Comentario
     */
    public function setHito(\Zubietxe\PrincipalBundle\Entity\Hito $hito = null)
    {
        $this->hito = $hito;

        return $this;
    }

    /**
     * Get hito
     *
     * @return \Zubietxe\PrincipalBundle\Entity\Hito 
     */
    public function getHito()
    {
        return $this->hito;
    }

    /**
     * Set idUnico
     *
     * @param \Zubietxe\PrincipalBundle\Entity\Persona $idUnico
     * @return Comentario
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
     * Set idActividad
     *
     * @param \Zubietxe\PrincipalBundle\Entity\Actividad $idActividad
     * @return Comentario
     */
    public function setIdActividad(\Zubietxe\PrincipalBundle\Entity\Actividad $idActividad = null)
    {
        $this->idActividad = $idActividad;

        return $this;
    }

    /**
     * Get idActividad
     *
     * @return \Zubietxe\PrincipalBundle\Entity\Actividad 
     */
    public function getIdActividad()
    {
        return $this->idActividad;
    }
}
