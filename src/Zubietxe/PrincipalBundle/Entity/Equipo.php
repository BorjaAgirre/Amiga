<?php

namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipo
 *
 * @ORM\Table(name="equipo")
 * @ORM\Entity
 */
class Equipo
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="nivel", type="string", length=20, nullable=true)
     */
    private $nivel;

    /**
     * @var string
     *
     * @ORM\Column(name="grupo", type="string", length=20, nullable=true)
     */
    private $grupo;

    /**
     * @var string
     *
     * @ORM\Column(name="pass", type="string", length=33, nullable=true)
     */
    private $pass;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ultima_cx", type="datetime", nullable=false)
     */
    private $ultimaCx;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Equipo
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
     * Set nivel
     *
     * @param string $nivel
     * @return Equipo
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return string 
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set grupo
     *
     * @param string $grupo
     * @return Equipo
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return string 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set pass
     *
     * @param string $pass
     * @return Equipo
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string 
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set ultimaCx
     *
     * @param \DateTime $ultimaCx
     * @return Equipo
     */
    public function setUltimaCx($ultimaCx)
    {
        $this->ultimaCx = $ultimaCx;

        return $this;
    }

    /**
     * Get ultimaCx
     *
     * @return \DateTime 
     */
    public function getUltimaCx()
    {
        return $this->ultimaCx;
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
}
