<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Doctechnique;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Utils\GestionGed;

/**
 * Doctechnique controller.
 *
 * @Route("doctechnique")
 */
class DoctechniqueController extends Controller
{
    /**
     * Lists all doctechnique entities.
     *
     * @Route("/", name="doctechnique_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $doctechniques = $em->getRepository('AppBundle:Doctechnique')->findAll();

        return $this->render('doctechnique/index.html.twig', array(
            'doctechniques' => $doctechniques,
        ));
    }

    /**
     * Creates a new doctechnique entity.
     *
     * @Route("/new", name="doctechnique_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $doctechnique = new Doctechnique();
//var_dump($request->get('appbundle_doctechnique[procede]'));

//exit();
        $em = $this->getDoctrine()->getManager();
        $sujetDocs = $em->getRepository('AppBundle:SujetDoc')->findAll();
        $pecheance = array();
        foreach ($sujetDocs as $sujetDoc){
            $pecheance[$sujetDoc->getId()] = $sujetDoc->getPecheance();
        }
        $form = $this->createForm('AppBundle\Form\DoctechniqueType', $doctechnique);
        $form->handleRequest($request);

       // $doctechnique = new Doctechnique();
        //$form = $this->createForm('AppBundle\Form\DoctechniqueType', $doctechnique);
       // $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gestionGed=new GestionGed();
            $em = $this->getDoctrine()->getManager();
            $file =  $doctechnique->getFichier();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $pathfile=$gestionGed->createfolderPath($this->container->getParameter('pathmedia'),$doctechnique->getIdEmploye()->getMatricule().'-'.$doctechnique->getIdEmploye()->getNom().' '.$doctechnique->getIdEmploye()->getPrenom(),$doctechnique->getTypeDoc()->getDossier());
            $file->move(

                $pathfile,
                $fileName
            );


            $doctechnique->setFichier($fileName);
            $doctechnique->setTypeDoc($doctechnique->getTypeDoc());
            $doctechnique->setIdEmploye($doctechnique->getIdEmploye());
            $em = $this->getDoctrine()->getManager();
            $em->persist($doctechnique);
            $em->flush();

            return $this->redirectToRoute('doctechnique_show', array('id' => $doctechnique->getId()));
        }
        $echeancesdocs = array('pecheance' => $pecheance);
        return $this->render('doctechnique/new.html.twig', array(
          'doctechnique' => $doctechnique,
            'echeancesdocs' =>$echeancesdocs,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a doctechnique entity.
     *
     * @Route("/{id}", name="doctechnique_show")
     * @Method("GET")
     */
    public function showAction(Doctechnique $doctechnique)
    {
        $deleteForm = $this->createDeleteForm($doctechnique);

        return $this->render('doctechnique/show.html.twig', array(
            'doctechnique' => $doctechnique,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing doctechnique entity.
     *
     * @Route("/{id}/edit", name="doctechnique_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Doctechnique $doctechnique)
    {


    $oldFile =$doctechnique->getFichier();
        $deleteForm = $this->createDeleteForm($doctechnique);
        $editForm = $this->createForm('AppBundle\Form\DoctechniqueType', $doctechnique);
        $editForm->handleRequest($request);



        if ($editForm->isSubmitted() && $editForm->isValid()) {
            //       $this->getDoctrine()->getManager()->flush();
            $newFile = $doctechnique->getFichier();

            if ($newFile != null) {

                $file =$doctechnique->getFichier();
                // $fileName = md5(uniqid()).$file->getClientOriginalName();
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $gestionGed = new GestionGed();
                $pathfile = $gestionGed->createfolderPath($this->container->getParameter('pathmedia'), $doctechnique->getIdEmploye()->getMatricule() . '-' . $doctechnique->getIdEmploye()->getNom() . ' ' . $doctechnique->getIdEmploye()->getPrenom(), $doctechnique->getTypeDoc()->getDossier());
                $file->move(
                //$this->getParameter('cv_directory'),
                //$this->container->getParameter('pathmedia').'cv',
                    $pathfile,
                    $fileName
                );

                $doctechnique->setFichier($fileName);
                $doctechnique->setTypeDoc($doctechnique->getTypeDoc());
                $doctechnique->setIdEmploye($doctechnique->getIdEmploye());

                $this->getDoctrine()->getManager()->flush();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Modification effectué avec succés'
                );
            } else {
                $doctechnique->setFichier($oldFile);
                $doctechnique->setTypeDoc($doctechnique->getTypeDoc());
                $doctechnique->setIdEmploye($doctechnique->getIdEmploye());

                $this->getDoctrine()->getManager()->flush();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Modification effectué avec succés'
                );
            }

            return $this->redirectToRoute('doctechnique_edit', array('id' =>$doctechnique->getId()));

        }
        return $this->render('doctechnique/edit.html.twig', array(
            'doctechnique' => $doctechnique,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));

    }





    /**
     * Deletes a doctechnique entity.
     *
     * @Route("/{id}", name="doctechnique_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Doctechnique $doctechnique)
    {
        $form = $this->createDeleteForm($doctechnique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($doctechnique);
            $em->flush();
        }

        return $this->redirectToRoute('doctechnique_index');
    }

    /**
     * Creates a form to delete a doctechnique entity.
     *
     * @param Doctechnique $doctechnique The doctechnique entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Doctechnique $doctechnique)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('doctechnique_delete', array('id' => $doctechnique->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
