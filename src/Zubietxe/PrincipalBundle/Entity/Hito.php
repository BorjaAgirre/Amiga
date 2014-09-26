<?php

namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hito
 *
 * @ORM\Table(name="hito")
 * @ORM\Entity
 */
class Hito
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_hito", type="string", length=30, nullable=true)
     */
    private $nombreHito;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_hito", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHito;



    /**
     * Set nombreHito
     *
     * @param string $nombreHito
     * @return Hito
     */
    public function setNombreHito($nombreHito)
    {
        $this->nombreHito = $nombreHito;

        return $this;
    }

    /**
     * Get nombreHito
     *
     * @return string 
     */
    public function getNombreHito()
    {
        return $this->nombreHito;
    }

    /**
     * Get idHito
     *
     * @return integer 
     */
    public function getIdHito()
    {
        return $this->idHito;
    }
}
