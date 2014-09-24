<?php

namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListaActividades
 *
 * @ORM\Table(name="lista_actividades")
 * @ORM\Entity
 */
class ListaActividades
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_actividad", type="string", length=20, nullable=true)
     */
    private $nombreActividad;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_listaactividad", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idListaactividad;



    /**
     * Set nombreActividad
     *
     * @param string $nombreActividad
     * @return ListaActividades
     */
    public function setNombreActividad($nombreActividad)
    {
        $this->nombreActividad = $nombreActividad;

        return $this;
    }

    /**
     * Get nombreActividad
     *
     * @return string 
     */
    public function getNombreActividad()
    {
        return $this->nombreActividad;
    }

    /**
     * Get idListaactividad
     *
     * @return integer 
     */
    public function getIdListaactividad()
    {
        return $this->idListaactividad;
    }
}
