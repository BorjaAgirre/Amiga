<?php

namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Varios
 *
 * @ORM\Table(name="varios")
 * @ORM\Entity
 */
class Varios
{
    /**
     * @var string
     *
     * @ORM\Column(name="variable", type="string", length=30, nullable=true)
     */
    private $variable;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=30, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="valor2", type="string", length=30, nullable=true)
     */
    private $valor2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cambio", type="datetime", nullable=true)
     */
    private $fechaCambio;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_varios", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVarios;



    /**
     * Set variable
     *
     * @param string $variable
     * @return Varios
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;

        return $this;
    }

    /**
     * Get variable
     *
     * @return string 
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * Set valor
     *
     * @param string $valor
     * @return Varios
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
     * Set valor2
     *
     * @param string $valor2
     * @return Varios
     */
    public function setValor2($valor2)
    {
        $this->valor2 = $valor2;

        return $this;
    }

    /**
     * Get valor2
     *
     * @return string 
     */
    public function getValor2()
    {
        return $this->valor2;
    }

    /**
     * Set fechaCambio
     *
     * @param \DateTime $fechaCambio
     * @return Varios
     */
    public function setFechaCambio($fechaCambio)
    {
        $this->fechaCambio = $fechaCambio;

        return $this;
    }

    /**
     * Get fechaCambio
     *
     * @return \DateTime 
     */
    public function getFechaCambio()
    {
        return $this->fechaCambio;
    }

    /**
     * Get idVarios
     *
     * @return integer 
     */
    public function getIdVarios()
    {
        return $this->idVarios;
    }
}
