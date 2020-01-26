<?php
 
namespace AppBundle\Controller;

use AppBundle\Entity\Doc;
use AppBundle\Entity\Employe;
use AppBundle\Entity\SujetDoc;
use AppBundle\Utils\GestionGed;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Doc controller.
 *
 * @Route("doc")
 */
class DocController extends Controller
{
    /**
     * Lists all doc entities.
     *
     * @Route("/", name="doc_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $docs = $em->getRepository('AppBundle:Doc')->findAll();
        $docstechnique = $em->getRepository('AppBundle:Doctechnique')->findAll();

        return $this->render('doc/index.html.twig', array(
            'docs' => $docs,
            'docstechnique' => $docstechnique,
        ));
    }

    /**
     * Creates a new doc entity.
     *
     * @Route("/new", name="doc_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $doc = new Doc();
       // $sujetdoc= new SujetDoc();
        //$employe=new Employe();
        $em = $this->getDoctrine()->getManager();
        $sujetDocs = $em->getRepository('AppBundle:SujetDoc')->findAll();
        $pecheance = array();
        foreach ($sujetDocs as $sujetDoc){
            $pecheance[$sujetDoc->getId()] = $sujetDoc->getPecheance();
        }
        $form = $this->createForm('AppBundle\Form\DocType', $doc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
       $gestionGed=new GestionGed();
            $em = $this->getDoctrine()->getManager();
            $file =  $doc->getFichier();
           // $fileName = md5(uniqid()).$file->getClientOriginalName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
         // $fileName = 'eeM'.$file->getClientOriginalName();
//$pathfile= $this->container->getParameter('pathmedia').$doc->getIdEmploye()->getMatricule().'-'.$doc->getIdEmploye()->getNom().'/'.$doc->getTypeDoc()->getDossier();

            $pathfile=$gestionGed->createfolderPath($this->container->getParameter('pathmedia'),$doc->getIdEmploye()->getMatricule().'-'.$doc->getIdEmploye()->getNom().' '.$doc->getIdEmploye()->getPrenom(),$doc->getTypeDoc()->getDossier());
$file->move(
                //$this->getParameter('cv_directory'),
               //$this->container->getParameter('pathmedia').'cv',
    $pathfile,
                $fileName
            );

            //$employe = $em->getRepository('AppBundle:Employe')->findOne($doc->getIdEmploye());
               // dump($doc->getTypeDoc());
           // dump($doc->getType());
//dump($doc->getIdEmploye());
          //  exit();
            $doc->setFichier($fileName);
          //  $doc->setEtat('valide');
          $doc->setTypeDoc($doc->getTypeDoc());
          $doc->setIdEmploye($doc->getIdEmploye());
            $em = $this->getDoctrine()->getManager();

            $em->persist($doc);
            $em->flush();

            return $this->redirectToRoute('doc_show', array('id' => $doc->getId()));
        }
        $echeancesdocs = array('pecheance' => $pecheance);
        return $this->render('doc/new.html.twig', array(
            'doc' => $doc,
            'echeancesdocs' =>$echeancesdocs,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a doc entity.
     *
     * @Route("/{id}", name="doc_show")
     * @Method("GET")
     */
    public function showAction(Doc $doc)
    {
        $deleteForm = $this->createDeleteForm($doc);

        return $this->render('doc/show.html.twig', array(
            'doc' => $doc,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing doc entity.
     *
     * @Route("/{id}/edit", name="doc_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Doc $doc)
    {
        $oldFile = $doc->getFichier();
        $deleteForm = $this->createDeleteForm($doc);
        $editForm = $this->createForm('AppBundle\Form\DocType', $doc);
        $editForm->handleRequest($request);



        if ($editForm->isSubmitted() && $editForm->isValid()) {
     //       $this->getDoctrine()->getManager()->flush();
            $newFile = $doc->getFichier();

            if ($newFile != null) {

                $file = $doc->getFichier();
                // $fileName = md5(uniqid()).$file->getClientOriginalName();
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $gestionGed = new GestionGed();
                $pathfile = $gestionGed->createfolderPath($this->container->getParameter('pathmedia'), $doc->getIdEmploye()->getMatricule() . '-' . $doc->getIdEmploye()->getNom() . ' ' . $doc->getIdEmploye()->getPrenom(), $doc->getTypeDoc()->getDossier());
                $file->move(
                //$this->getParameter('cv_directory'),
                //$this->container->getParameter('pathmedia').'cv',
                    $pathfile,
                    $fileName
                );

                $doc->setFichier($fileName);
                $doc->setTypeDoc($doc->getTypeDoc());
                $doc->setIdEmploye($doc->getIdEmploye());

                $this->getDoctrine()->getManager()->flush();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Modification effectué avec succés'
                );
            } else {
                $doc->setFichier($oldFile);
                $doc->setTypeDoc($doc->getTypeDoc());
                $doc->setIdEmploye($doc->getIdEmploye());

                $this->getDoctrine()->getManager()->flush();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Modification effectué avec succés'
                );
            }

            return $this->redirectToRoute('doc_edit', array('id' => $doc->getId()));

        }
        return $this->render('doc/edit.html.twig', array(
            'doc' => $doc,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a doc entity.
     *
     * @Route("/{id}", name="doc_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Doc $doc)
    {
        $form = $this->createDeleteForm($doc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($doc);
            $em->flush();
        }

        return $this->redirectToRoute('doc_index');
    }

    /**
     * Creates a form to delete a doc entity.
     *
     * @param Doc $doc The doc entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Doc $doc)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('doc_delete', array('id' => $doc->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
