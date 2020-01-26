<?php
/**
 * Created by PhpStorm.
 * User: zied
 * Date: 06/02/2019
 * Time: 15:44
 */

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;

class DoctechniqueRepository extends EntityRepository
{

    public function findbyListeDocecheance($annefinb)
    {

        // $annefinc=new \DateTime('now - 0day');
        $annefinc=new \DateTime('now - 0day');

        $annefin=$annefinb->format('Y-m-d');

        $dql_query = $this->_em->createQuery("
    SELECT d FROM AppBundle:Doctechnique d JOIN d.typeDoc t  
        
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
    SELECT d FROM AppBundle:Doctechnique d JOIN d.typeDoc t  
        
    WHERE 

t.pecheance LIKE 'oui' AND d.etat LIKE  'Valide' AND d.notifier LIKE  'Non'  "
//
        );
        // $listdoc= $dql_query->getSingleScalarResult();
        $listdoc= $dql_query->getResult();

        return  $listdoc;
    }

public function findbyCritere($famille='',$methode='',$procede=''){
$dql_query = $this->_em->createQuery("
    SELECT d FROM AppBundle:Doctechnique d JOIN  d.idprocede p JOIN p.idmethodedisp m JOIN m.idfamilleInsp f 
        
    WHERE 

 p.id LIKE '%".$procede."%' AND m.id LIKE '%".$methode."%' AND f.id LIKE '%".$famille."%' "
//
);
    // $listdoc= $dql_query->getSingleScalarResult();
$listdoc= $dql_query->getResult();

return  $listdoc;
}


}