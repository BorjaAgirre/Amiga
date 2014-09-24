<?php

namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Indicadores
 *
 * @ORM\Table(name="indicadores")
 * @ORM\Entity
 */
class Indicadores
{
    /**
     * @var string
     *
     * @ORM\Column(name="indicador", type="string", length=15, nullable=true)
     */
    private $indicador;

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="string", length=255, nullable=true)
     */
    private $texto;

    /**
     * @var integer
     *
     * @ORM\Column(name="valorIndicador", type="integer", nullable=true)
     */
    private $valorindicador;

    /**
     * @var string
     *
     * @ORM\Column(name="valorable", type="string", length=1, nullable=true)
     */
    private $valorable;

    /**
     * @var integer
     *
     * @ORM\Column(name="valorInstrum", type="integer", nullable=true)
     */
    private $valorinstrum;

    /**
     * @var integer
     *
     * @ORM\Column(name="subvalorInstrum", type="integer", nullable=true)
     */
    private $subvalorinstrum;

    /**
     * @var string
     *
     * @ORM\Column(name="otro", type="string", length=2, nullable=true)
     */
    private $otro;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set indicador
     *
     * @param string $indicador
     * @return Indicadores
     */
    public function setIndicador($indicador)
    {
        $this->indicador = $indicador;

        return $this;
    }

    /**
     * Get indicador
     *
     * @return string 
     */
    public function getIndicador()
    {
        return $this->indicador;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return Indicadores
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set valorindicador
     *
     * @param integer $valorindicador
     * @return Indicadores
     */
    public function setValorindicador($valorindicador)
    {
        $this->valorindicador = $valorindicador;

        return $this;
    }

    /**
     * Get valorindicador
     *
     * @return integer 
     */
    public function getValorindicador()
    {
        return $this->valorindicador;
    }

    /**
     * Set valorable
     *
     * @param string $valorable
     * @return Indicadores
     */
    public function setValorable($valorable)
    {
        $this->valorable = $valorable;

        return $this;
    }

    /**
     * Get valorable
     *
     * @return string 
     */
    public function getValorable()
    {
        return $this->valorable;
    }

    /**
     * Set valorinstrum
     *
     * @param integer $valorinstrum
     * @return Indicadores
     */
    public function setValorinstrum($valorinstrum)
    {
        $this->valorinstrum = $valorinstrum;

        return $this;
    }

    /**
     * Get valorinstrum
     *
     * @return integer 
     */
    public function getValorinstrum()
    {
        return $this->valorinstrum;
    }

    /**
     * Set subvalorinstrum
     *
     * @param integer $subvalorinstrum
     * @return Indicadores
     */
    public function setSubvalorinstrum($subvalorinstrum)
    {
        $this->subvalorinstrum = $subvalorinstrum;

        return $this;
    }

    /**
     * Get subvalorinstrum
     *
     * @return integer 
     */
    public function getSubvalorinstrum()
    {
        return $this->subvalorinstrum;
    }

    /**
     * Set otro
     *
     * @param string $otro
     * @return Indicadores
     */
    public function setOtro($otro)
    {
        $this->otro = $otro;

        return $this;
    }

    /**
     * Get otro
     *
     * @return string 
     */
    public function getOtro()
    {
        return $this->otro;
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
