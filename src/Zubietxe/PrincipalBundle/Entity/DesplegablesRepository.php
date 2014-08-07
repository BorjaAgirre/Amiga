<?php
// src/Zubietxe/PrincipalBundle/Entity/DesplegablesRepository.php
namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\EntityRepository;

class DesplegablesRepository extends EntityRepository
{
    public function findDesplegable($tabla)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT d FROM ZubietxePrincipalBundle:Desplegables d WHERE d.despl = :tabla ORDER BY d.idDespl ASC'
            )->setParameter('tabla', $tabla);
            return $query->getResult();
    }
}