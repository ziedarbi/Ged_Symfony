<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FamilleInsp;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Familleinsp controller.
 *
 * @Route("familleinsp")
 */
class FamilleInspController extends Controller
{
    /**
     * Lists all familleInsp entities.
     *
     * @Route("/", name="familleinsp_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $familleInsps = $em->getRepository('AppBundle:FamilleInsp')->findAll();

        return $this->render('familleinsp/index.html.twig', array(
            'familleInsps' => $familleInsps,
        ));
    }



    /**
     * Lists all niveauGrade entities.
     *
     * @Route("/findmethode/{idfamille}", name="findmethode")
     * @Method({"POST","GET"})
     */
    public function findprocedeAction(FamilleInsp $idfamille)
    {
        $em = $this->getDoctrine()->getManager();

        $methodes = $em->getRepository('AppBundle:MethodeDispline')->findbyfamille($idfamille->getId());


        foreach ($methodes as $methode){

            $data[] = array('id'=>$methode->getId(),'nom'=>$methode->getNom());
        }

        return new JsonResponse($data);


    }

    /**
     * Creates a new familleInsp entity.
     *
     * @Route("/new", name="familleinsp_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $familleInsp = new Familleinsp();
        $form = $this->createForm('AppBundle\Form\FamilleInspType', $familleInsp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($familleInsp);
            $em->flush();

            return $this->redirectToRoute('familleinsp_show', array('id' => $familleInsp->getId()));
        }

        return $this->render('familleinsp/new.html.twig', array(
            'familleInsp' => $familleInsp,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a familleInsp entity.
     *
     * @Route("/{id}", name="familleinsp_show")
     * @Method("GET")
     */
    public function showAction(FamilleInsp $familleInsp)
    {
        $deleteForm = $this->createDeleteForm($familleInsp);

        return $this->render('familleinsp/show.html.twig', array(
            'familleInsp' => $familleInsp,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing familleInsp entity.
     *
     * @Route("/{id}/edit", name="familleinsp_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FamilleInsp $familleInsp)
    {
        $deleteForm = $this->createDeleteForm($familleInsp);
        $editForm = $this->createForm('AppBundle\Form\FamilleInspType', $familleInsp);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('familleinsp_edit', array('id' => $familleInsp->getId()));
        }

        return $this->render('familleinsp/edit.html.twig', array(
            'familleInsp' => $familleInsp,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a familleInsp entity.
     *
     * @Route("/{id}", name="familleinsp_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FamilleInsp $familleInsp)
    {
        $form = $this->createDeleteForm($familleInsp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($familleInsp);
            $em->flush();
        }

        return $this->redirectToRoute('familleinsp_index');
    }

    /**
     * Creates a form to delete a familleInsp entity.
     *
     * @param FamilleInsp $familleInsp The familleInsp entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FamilleInsp $familleInsp)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('familleinsp_delete', array('id' => $familleInsp->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
