<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MethodeDispline;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Methodedispline controller.
 *
 * @Route("methodedispline")
 */
class MethodeDisplineController extends Controller
{
    /**
     * Lists all methodeDispline entities.
     *
     * @Route("/", name="methodedispline_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $methodeDisplines = $em->getRepository('AppBundle:MethodeDispline')->findAll();

        return $this->render('methodedispline/index.html.twig', array(
            'methodeDisplines' => $methodeDisplines,
        ));
    }


    /**
     *
     * @Route("/findprocede/{idmethode}", name="findprocedeMethode")
     * @Method({"POST","GET"})
     */
    public function findprocedeAction(MethodeDispline $idmethode)
    {
        $em = $this->getDoctrine()->getManager();

        $procedes = $em->getRepository('AppBundle:Procede')->findby(array('idmethodedisp'=>$idmethode));


        foreach ($procedes as $procede){

            $data[] = array('id'=>$procede->getId(),'nom'=>$procede->getNomprocede());
        }

        return new JsonResponse($data);


    }


    /**
     * Creates a new methodeDispline entity.
     *
     * @Route("/new", name="methodedispline_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $methodeDispline = new Methodedispline();
        $form = $this->createForm('AppBundle\Form\MethodeDisplineType', $methodeDispline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($methodeDispline);
            $em->flush();

            return $this->redirectToRoute('methodedispline_show', array('id' => $methodeDispline->getId()));
        }

        return $this->render('methodedispline/new.html.twig', array(
            'methodeDispline' => $methodeDispline,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a methodeDispline entity.
     *
     * @Route("/{id}", name="methodedispline_show")
     * @Method("GET")
     */
    public function showAction(MethodeDispline $methodeDispline)
    {
        $deleteForm = $this->createDeleteForm($methodeDispline);

        return $this->render('methodedispline/show.html.twig', array(
            'methodeDispline' => $methodeDispline,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing methodeDispline entity.
     *
     * @Route("/{id}/edit", name="methodedispline_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MethodeDispline $methodeDispline)
    {
        $deleteForm = $this->createDeleteForm($methodeDispline);
        $editForm = $this->createForm('AppBundle\Form\MethodeDisplineType', $methodeDispline);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('methodedispline_edit', array('id' => $methodeDispline->getId()));
        }

        return $this->render('methodedispline/edit.html.twig', array(
            'methodeDispline' => $methodeDispline,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a methodeDispline entity.
     *
     * @Route("/{id}", name="methodedispline_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MethodeDispline $methodeDispline)
    {
        $form = $this->createDeleteForm($methodeDispline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($methodeDispline);
            $em->flush();
        }

        return $this->redirectToRoute('methodedispline_index');
    }

    /**
     * Creates a form to delete a methodeDispline entity.
     *
     * @param MethodeDispline $methodeDispline The methodeDispline entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MethodeDispline $methodeDispline)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('methodedispline_delete', array('id' => $methodeDispline->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
