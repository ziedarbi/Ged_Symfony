<?php
/**
 * Created by PhpStorm.
 * User: zied
 * Date: 06/02/2019
 * Time: 15:34
 */

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;

class DocRepository extends EntityRepository
{

    public function findbyListeDocecheance($annefinb)
    {

       // $annefinc=new \DateTime('now - 0day');
        $annefinc=new \DateTime('now - 0day');

        $annefin=$annefinb->format('Y-m-d');

        $dql_query = $this->_em->createQuery("
    SELECT d FROM AppBundle:Doc d JOIN d.typeDoc t  
        
    WHERE 

t.pecheance LIKE 'oui' AND  d.etat LIKE  'Valide' AND d.date_validite  <  '".$annefin."' "

        );
       // $listdoc= $dql_query->getSingleScalarResult();
 $listdoc= $dql_query->getResult();

        return  $listdoc;
    }



    public function findbyListeDocnotnotifier()
    {


        $dql_query = $this->_em->createQuery("
    SELECT d FROM AppBundle:Doc d JOIN d.typeDoc t  
        
    WHERE 

t.pecheance LIKE 'oui' AND d.etat LIKE  'Valide' AND d.notifier LIKE  'Non'  "
//
        );
        // $listdoc= $dql_query->getSingleScalarResult();
        $listdoc= $dql_query->getResult();

        return  $listdoc;
    }


}