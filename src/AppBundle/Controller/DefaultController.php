<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Machine;
use AppBundle\Entity\Production;
use AppBundle\Entity\User;
use AppBundle\Utils\GestionProd;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use AppBundle\Form\RechperiodeType;
use Symfony\Component\Form\Forms;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $em = $this->getDoctrine()->getManager();

        $docs = $em->getRepository('AppBundle:Doc')->findAll();
        $nbredocs=sizeof($docs);
        $employees = $em->getRepository('AppBundle:Employe')->findAll();
        $nbremployees=sizeof($employees );
        $typedocs = $em->getRepository('AppBundle:SujetDoc')->findAll();
        $nbretypedocs=sizeof($typedocs );
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('RH/index.html.twig', array(
            'nbredocs' => $nbredocs,
            'sujetDocs' => $typedocs,
            'docs' => $docs ,
            'nbremployees' => $nbremployees,
            'nbretypedocs' => $nbretypedocs,
        ));
    }



    /**
     * @Route("/Listeecheance", name="Listeecheance")
     */
    public function ListeecheanceAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $annefinb=new \DateTime('now - 0day');
        $docs = $em->getRepository('AppBundle:Doc')-> findbyListeDocecheance($annefinb);
        $docstechnique = $em->getRepository('AppBundle:Doctechnique')-> findbyListeDocecheance($annefinb);
        // $docstechnique = $em->getRepository('AppBundle:Doctechnique')->findAll();


        // replace this example code with whatever you need
        return $this->render('RH/Listeecheances.html.twig', array(
            'docs' => $docs,
            'docstechnique' => $docstechnique,
        ));
    }
    /**
     * @Route("/EnvoiMailNotif", name="EnvoiMailNotif")
     */
    public function EnvoiMailNotifAction(Request $request)
    {



        $em = $this->getDoctrine()->getManager();
        $annefinb=new \DateTime('now - 0day');
        $docs = $em->getRepository('AppBundle:Doc')-> findbyListeDocnotnotifier();
        $doctechnique = $em->getRepository('AppBundle:Doctechnique')-> findbyListeDocnotnotifier();
        $cejourb=new \DateTime('now - 0day');

        $cejour=$cejourb->format('Y-m-d');

 foreach ($docs as $doc) {
     $datevali = $doc->getDateValidite();
     $datevalidite = $datevali->format('Y-m-d');
     $nbrejour = $doc->getTypeDoc()->getNbrejournotif();
     $datenotif = new \DateTime($datevalidite . ' - ' . $nbrejour . ' day');
     $datenotification = $datenotif->format('Y-m-d');

 $user= $this->get('security.token_storage')->getToken()->getUser();
 $emailuser=$user->getEmail();
     if ($datenotification < $cejour) {


         $mail = \Swift_Message::newInstance()
             ->setSubject('notification echeance document ')
             ->setFrom($this->container->getParameter('mailer_user'))
             ->setTo($emailuser)

             ->setBody(
                 $this->renderView(

                     'notification/email.html.twig',
                     array('name' => $doc->getNom(),
                         'datevalidite' => $doc->getDateValidite())
                 ),
                 'text/html'
             );
         $this->get('mailer')->send($mail);
         $doc->SetNotifier('Oui');
         $this->getDoctrine()->getManager()->flush();
     }
 }
// doc technique

        foreach ($doctechnique as $doc) {
            $datevali = $doc->getDateValidite();
            $datevalidite = $datevali->format('Y-m-d');
            $nbrejour = $doc->getTypeDoc()->getNbrejournotif();
            $datenotif = new \DateTime($datevalidite . ' - ' . $nbrejour . ' day');
            $datenotification = $datenotif->format('Y-m-d');

            if ($datenotification < $cejour) {


                $mail = \Swift_Message::newInstance()
                    ->setSubject('notification echeance document  ')
                    ->setFrom($this->container->getParameter('mailer_user'))
                    ->setTo($emailuser)
                   
                    ->setBody(
                        $this->renderView(

                            'notification/email.html.twig',
                            array('name' => $doc->getNom(),
                                'datevalidite' => $doc->getDateValidite())
                        ),
                        'text/html'
                    );
                $this->get('mailer')->send($mail);
                $doc->SetNotifier('Oui');
                $this->getDoctrine()->getManager()->flush();
            }
        }

 //exit();
        // replace this example code with whatever you need
        return $this->redirectToRoute('Listeecheance');

}


    /**
     * @Route("/accessDenied", name="accessDenied")
     */
    public function accessDeniedAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/AccessDenied.html.twig');
    }


    /**
     * @Route("/Prod/recherche", name="resRecherche")
     * @Method({"POST","GET"})
     */
    public function resRechercheAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();



        $form = $this->createForm('AppBundle\Form\SearchDoctechniqueType',NULL,array('required'=>true));

        $form->handleRequest($request);
        $datasearch=false;
        $doctechniques="";
        if ($form->isSubmitted() ) {

            $famille='';
            $methode ='';
            $procede ='';
            $niveaugrade ='';
            if(isset(  $request->request->get('appbundle_searchdoctechnique')['famille'])) {
                $famille = $request->request->get('appbundle_searchdoctechnique')['famille'];
            }
if(isset(  $request->request->get('appbundle_searchdoctechnique')['Methode'])) {
    $methode = $request->request->get('appbundle_searchdoctechnique')['Methode'];
}
            if(isset(  $request->request->get('appbundle_searchdoctechnique')['procede'])) {
                $procede = $request->request->get('appbundle_searchdoctechnique')['procede'];
            }
                if(isset(  $request->request->get('appbundle_searchdoctechnique')['idniveaugrade'])) {
                    $niveaugrade = $request->request->get('appbundle_searchdoctechnique')['idniveaugrade'];
                }

    $doctechniques = $em->getRepository('AppBundle:Doctechnique')->findbyCritere($famille, $methode, $procede);

            return $this->render('doctechnique/Searchdoctech.html.twig',array('doctechniques'=> $doctechniques,'form' => $form->createView() ));

        }
        else {

            return $this->render('doctechnique/Searchdoctech.html.twig', array( 'doctechniques'=>$doctechniques, 'form' => $form->createView()));
        }


    }




    public function menuAction()
    {

     
        return $this->render('default/menu.html.twig');


    }


}
