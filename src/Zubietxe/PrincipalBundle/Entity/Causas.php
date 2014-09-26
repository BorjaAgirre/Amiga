<?php

namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Causas
 *
 * @ORM\Table(name="causas")
 * @ORM\Entity
 */
class Causas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_unico", type="integer", nullable=true)
     */
    private $idUnico;

    /**
     * @var string
     *
     * @ORM\Column(name="organo_judicial", type="string", length=30, nullable=true)
     */
    private $organoJudicial;

    /**
     * @var string
     *
     * @ORM\Column(name="situacion", type="string", length=30, nullable=true)
     */
    private $situacion;

    /**
     * @var string
     *
     * @ORM\Column(name="abogado", type="string", length=30, nullable=true)
     */
    private $abogado;

    /**
     * @var string
     *
     * @ORM\Column(name="citaciones", type="string", length=30, nullable=true)
     */
    private $citaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="condena", type="string", length=30, nullable=true)
     */
    private $condena;

    /**
     * @var string
     *
     * @ORM\Column(name="informes", type="string", length=30, nullable=true)
     */
    private $informes;

    /**
     * @var string
     *
     * @ORM\Column(name="domicilio", type="string", length=30, nullable=true)
     */
    private $domicilio;

    /**
     * @var string
     *
     * @ORM\Column(name="informes2", type="string", length=30, nullable=true)
     */
    private $informes2;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_causa", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCausa;



    /**
     * Set idUnico
     *
     * @param integer $idUnico
     * @return Causas
     */
    public function setIdUnico($idUnico)
    {
        $this->idUnico = $idUnico;

        return $this;
    }

    /**
     * Get idUnico
     *
     * @return integer 
     */
    public function getIdUnico()
    {
        return $this->idUnico;
    }

    /**
     * Set organoJudicial
     *
     * @param string $organoJudicial
     * @return Causas
     */
    public function setOrganoJudicial($organoJudicial)
    {
        $this->organoJudicial = $organoJudicial;

        return $this;
    }

    /**
     * Get organoJudicial
     *
     * @return string 
     */
    public function getOrganoJudicial()
    {
        return $this->organoJudicial;
    }

    /**
     * Set situacion
     *
     * @param string $situacion
     * @return Causas
     */
    public function setSituacion($situacion)
    {
        $this->situacion = $situacion;

        return $this;
    }

    /**
     * Get situacion
     *
     * @return string 
     */
    public function getSituacion()
    {
        return $this->situacion;
    }

    /**
     * Set abogado
     *
     * @param string $abogado
     * @return Causas
     */
    public function setAbogado($abogado)
    {
        $this->abogado = $abogado;

        return $this;
    }

    /**
     * Get abogado
     *
     * @return string 
     */
    public function getAbogado()
    {
        return $this->abogado;
    }

    /**
     * Set citaciones
     *
     * @param string $citaciones
     * @return Causas
     */
    public function setCitaciones($citaciones)
    {
        $this->citaciones = $citaciones;

        return $this;
    }

    /**
     * Get citaciones
     *
     * @return string 
     */
    public function getCitaciones()
    {
        return $this->citaciones;
    }

    /**
     * Set condena
     *
     * @param string $condena
     * @return Causas
     */
    public function setCondena($condena)
    {
        $this->condena = $condena;

        return $this;
    }

    /**
     * Get condena
     *
     * @return string 
     */
    public function getCondena()
    {
        return $this->condena;
    }

    /**
     * Set informes
     *
     * @param string $informes
     * @return Causas
     */
    public function setInformes($informes)
    {
        $this->informes = $informes;

        return $this;
    }

    /**
     * Get informes
     *
     * @return string 
     */
    public function getInformes()
    {
        return $this->informes;
    }

    /**
     * Set domicilio
     *
     * @param string $domicilio
     * @return Causas
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Get domicilio
     *
     * @return string 
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set informes2
     *
     * @param string $informes2
     * @return Causas
     */
    public function setInformes2($informes2)
    {
        $this->informes2 = $informes2;

        return $this;
    }

    /**
     * Get informes2
     *
     * @return string 
     */
    public function getInformes2()
    {
        return $this->informes2;
    }

    /**
     * Get idCausa
     *
     * @return integer 
     */
    public function getIdCausa()
    {
        return $this->idCausa;
    }
}
