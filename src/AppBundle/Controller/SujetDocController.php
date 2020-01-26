<?php
 
namespace AppBundle\Controller;

use AppBundle\Entity\SujetDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Sujetdoc controller.
 *
 * @Route("TypeDocument")
 */
class SujetDocController extends Controller
{
    /**
     * Lists all sujetDoc entities.
     *
     * @Route("/", name="TypeDocument_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sujetDocs = $em->getRepository('AppBundle:SujetDoc')->findAll();

        return $this->render('sujetdoc/index.html.twig', array(
            'sujetDocs' => $sujetDocs,
        ));
    }

    /**
     * Creates a new sujetDoc entity.
     *
     * @Route("/new", name="TypeDocument_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sujetDoc = new Sujetdoc();
        $form = $this->createForm('AppBundle\Form\SujetDocType', $sujetDoc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sujetDoc);
            $em->flush();

            return $this->redirectToRoute('TypeDocument_show', array('id' => $sujetDoc->getId()));
        }

        return $this->render('sujetdoc/new.html.twig', array(
            'sujetDoc' => $sujetDoc,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sujetDoc entity.
     *
     * @Route("/{id}", name="TypeDocument_show")
     * @Method("GET")
     */
    public function showAction(SujetDoc $sujetDoc)
    {
        $deleteForm = $this->createDeleteForm($sujetDoc);
        $em = $this->getDoctrine()->getManager();

        $docs = $em->getRepository('AppBundle:Doc')->findBy(array('typeDoc' =>$sujetDoc->getId()));

        return $this->render('sujetdoc/show.html.twig', array(
            'sujetDoc' => $sujetDoc,
            'docs' => $docs,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sujetDoc entity.
     *
     * @Route("/{id}/edit", name="TypeDocument_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SujetDoc $sujetDoc)
    {
        $deleteForm = $this->createDeleteForm($sujetDoc);
        $editForm = $this->createForm('AppBundle\Form\SujetDocType', $sujetDoc);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            // $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Modification effectué avec succés'
            );
            return $this->redirectToRoute('TypeDocument_edit', array('id' => $sujetDoc->getId()));
        }

        return $this->render('sujetdoc/edit.html.twig', array(
            'sujetDoc' => $sujetDoc,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sujetDoc entity.
     *
     * @Route("/{id}", name="TypeDocument_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SujetDoc $sujetDoc)
    {
        $form = $this->createDeleteForm($sujetDoc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sujetDoc);
            $em->flush();
        }

        return $this->redirectToRoute('TypeDocument_index');
    }

    /**
     * Creates a form to delete a sujetDoc entity.
     *
     * @param SujetDoc $sujetDoc The sujetDoc entity
     *
     * @return \Symfony\Component\Form\Form The feorm
     */
    private function createDeleteForm(SujetDoc $sujetDoc)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('TypeDocument_delete', array('id' => $sujetDoc->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
