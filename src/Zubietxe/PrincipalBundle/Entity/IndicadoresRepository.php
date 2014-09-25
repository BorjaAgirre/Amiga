<?php
// src/Zubietxe/PrincipalBundle/Entity/IndicadoresRepository.php
namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\EntityRepository;

class IndicadoresRepository extends EntityRepository
{
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
}