<?php
/**
 * Created by PhpStorm.
 * User: zied
 * Date: 07/02/2019
 * Time: 10:31
 */

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;

 
class NiveauGradeRepository extends EntityRepository
{

public function findbynomprocede($idprocede){

    $dql_query = $this->_em->createQuery("
    SELECT n.nomniveaugrade , n.id  FROM AppBundle:NiveauGrade n JOIN n.idprocede p  
        
    WHERE 

p.id LIKE '".$idprocede."'  "
//
    );
    $listdoc= $dql_query->getResult();

    return  $listdoc;
}

}