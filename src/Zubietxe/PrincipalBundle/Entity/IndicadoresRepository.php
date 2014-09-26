<?php
// src/Zubietxe/PrincipalBundle/Entity/IndicadoresRepository.php
namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\EntityRepository;

class IndicadoresRepository extends EntityRepository
{


    public function opcionesIndicador()
    {
 
        // Esta parte es por si queremos rellenar el valor 0 de las posibles respuestas de indicadores. 
        // Otra alternativa puede ser utilizar la opción 'empty_value' en PersonaType.php
        // Pero no me ha funcionado muy bien. 

        // En primer lugar rellenamos todos los valores 0 de cada desplegable
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT i FROM ZubietxePrincipalBundle:Indicadores i GROUP BY i.indicador'
            );
            $result = $query->getResult();
            foreach ($result as $row)  {
                $opcion[$row->getIndicador()][0] = "---";
            }
 

            // Después rellenamos los valores de los desplegables con las respuestas a los indicadores, y los títulos       
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT i FROM ZubietxePrincipalBundle:Indicadores i ORDER BY i.indicador, i.valorindicador ASC'
            );
            $result = $query->getResult();
            foreach ($result as $row)  {
                if ($row->getTitulo() == 'i') {
                    $opcion[$row->getIndicador()][$row->getValorIndicador()] =  $row->getTexto();
                } else {
                    $titulo[$row->getIndicador()] =  $row->getTexto();
                }
            }
            return array($opcion, $titulo); 
    }



    public function findRespuestas($indicador)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT d FROM ZubietxePrincipalBundle:Indicadores d WHERE d.indicador = :indicador ORDER BY d.id ASC'
            )->setParameter('indicador', $indicador);
            $result = $query->getResult();
            $retorna[0] = "";
            foreach ($result as $row)  {
           		$retorna[$row->getValorindicador()] = $row->getTexto();
            }
            return $retorna; 
    }



    public function findTitulo($indicador)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT d FROM ZubietxePrincipalBundle:Indicadores d WHERE d.indicador = :indicador ORDER BY d.id ASC'
            )->setParameter('indicador', $indicador);
            $result = $query->getResult();
            $retorna[0] = "";
            foreach ($result as $row)  {
                $retorna[$row->getValorindicador()] = $row->getTexto();
            }
            return $retorna; 
    }
}