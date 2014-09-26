<?php
// src/Zubietxe/PrincipalBundle/Entity/IndicadoresRepository.php
namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\EntityRepository;

class IndicadoresRepository extends EntityRepository
{


    public function opcionesIndicador()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT i FROM ZubietxePrincipalBundle:Indicadores i ORDER BY i.indicador ASC'
            );
            $result = $query->getResult();
            $ultimo_ind = "";
            foreach ($result as $row)  {
 //               if ($row->getIndicador() == $ultimo_ind) {
                    $retorna[$row->getIndicador()][$row->getValorIndicador()] =  $row->getTexto();
 //               }
 //               $ultimo_ind = $row->getIndicador();

            }
            return $retorna; 
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