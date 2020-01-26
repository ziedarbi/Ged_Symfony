<?php
/**
 * Created by PhpStorm.
 * User: zied
 * Date: 07/02/2019
 * Time: 10:34
 */

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;

class MethodeDisplineRepository extends EntityRepository
{

    public function findbyfamille($idfamille)
    {


        $dql_query = $this->_em->createQuery("
    SELECT  m FROM AppBundle:MethodeDispline m JOIN m.idfamilleInsp f  
        
    WHERE 

f.id LIKE '".$idfamille."' "
//
        );
        // $listdoc= $dql_query->getSingleScalarResult();
        $listMethode= $dql_query->getResult();

        return  $listMethode;
    }

}