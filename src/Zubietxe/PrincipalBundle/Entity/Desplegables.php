<?php

namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Desplegables
 *
 * @ORM\Table(name="desplegables")
 * @ORM\Entity(repositoryClass="Zubietxe\PrincipalBundle\Entity\DesplegablesRepository")
 */
class Desplegables
{
    /**
     * @var string
     *
     * @ORM\Column(name="despl", type="string", length=20, nullable=true)
     */
    private $despl;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_despl", type="integer", nullable=true)
     */
    private $idDespl;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=40, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="dato1", type="integer", nullable=true)
     */
    private $dato1;

    /**
     * @var integer
     *
     * @ORM\Column(name="dato2", type="integer", nullable=true)
     */
    private $dato2;

    /**
     * @var string
     *
     * @ORM\Column(name="datotexto", type="string", length=45, nullable=true)
     */
    private $datotexto;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_gral", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGral;



    /**
     * Set despl
     *
     * @param string $despl
     * @return Desplegables
     */
    public function setDespl($despl)
    {
        $this->despl = $despl;

        return $this;
    }

    /**
     * Get despl
     *
     * @return string 
     */
    public function getDespl()
    {
        return $this->despl;
    }

    /**
     * Set idDespl
     *
     * @param integer $idDespl
     * @return Desplegables
     */
    public function setIdDespl($idDespl)
    {
        $this->idDespl = $idDespl;

        return $this;
    }

    /**
     * Get idDespl
     *
     * @return integer 
     */
    public function getIdDespl()
    {
        return $this->idDespl;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Desplegables
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
     * Set dato1
     *
     * @param integer $dato1
     * @return Desplegables
     */
    public function setDato1($dato1)
    {
        $this->dato1 = $dato1;

        return $this;
    }

    /**
     * Get dato1
     *
     * @return integer 
     */
    public function getDato1()
    {
        return $this->dato1;
    }

    /**
     * Set dato2
     *
     * @param integer $dato2
     * @return Desplegables
     */
    public function setDato2($dato2)
    {
        $this->dato2 = $dato2;

        return $this;
    }

    /**
     * Get dato2
     *
     * @return integer 
     */
    public function getDato2()
    {
        return $this->dato2;
    }

    /**
     * Set datotexto
     *
     * @param string $datotexto
     * @return Desplegables
     */
    public function setDatotexto($datotexto)
    {
        $this->datotexto = $datotexto;

        return $this;
    }

    /**
     * Get datotexto
     *
     * @return string 
     */
    public function getDatotexto()
    {
        return $this->datotexto;
    }

    /**
     * Get idGral
     *
     * @return integer 
     */
    public function getIdGral()
    {
        return $this->idGral;
    }
}
