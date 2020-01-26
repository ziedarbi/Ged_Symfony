<?php

namespace AppBundle\Controller;

use AppBundle\Entity\NiveauGrade;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\HttpFoundation\Response;
/**
 * Niveaugrade controller.
 *
 * @Route("niveaugrade")
 */
class NiveauGradeController extends Controller
{
    /**
     * Lists all niveauGrade entities.
     *
     * @Route("/", name="niveaugrade_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $niveauGrades = $em->getRepository('AppBundle:NiveauGrade')->findAll();

        return $this->render('niveaugrade/index.html.twig', array(
            'niveauGrades' => $niveauGrades,
        ));
    }


    /**
     * Lists all niveauGrade entities.
     *
     * @Route("/idprocede/{idprocede}", name="niveaugrade_idprocede")
     * @Method({"POST","GET"})
     */
    public function idprocedeAction($idprocede)
    {
        $em = $this->getDoctrine()->getManager();

        $niveauGrades = $em->getRepository('AppBundle:NiveauGrade')->findbyNomprocede($idprocede);

           return new JsonResponse($niveauGrades);


    }


    /**
     * Creates a new niveauGrade entity.
     *
     * @Route("/new", name="niveaugrade_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $niveauGrade = new Niveaugrade();
        $form = $this->createForm('AppBundle\Form\NiveauGradeType', $niveauGrade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($niveauGrade);
            $em->flush();

            return $this->redirectToRoute('niveaugrade_show', array('id' => $niveauGrade->getId()));
        }

        return $this->render('niveaugrade/new.html.twig', array(
            'niveauGrade' => $niveauGrade,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a niveauGrade entity.
     *
     * @Route("/{id}", name="niveaugrade_show")
     * @Method("GET")
     */
    public function showAction(NiveauGrade $niveauGrade)
    {
        $deleteForm = $this->createDeleteForm($niveauGrade);

        return $this->render('niveaugrade/show.html.twig', array(
            'niveauGrade' => $niveauGrade,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing niveauGrade entity.
     *
     * @Route("/{id}/edit", name="niveaugrade_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, NiveauGrade $niveauGrade)
    {
        $deleteForm = $this->createDeleteForm($niveauGrade);
        $editForm = $this->createForm('AppBundle\Form\NiveauGradeType', $niveauGrade);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('niveaugrade_edit', array('id' => $niveauGrade->getId()));
        }

        return $this->render('niveaugrade/edit.html.twig', array(
            'niveauGrade' => $niveauGrade,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a niveauGrade entity.
     *
     * @Route("/{id}", name="niveaugrade_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, NiveauGrade $niveauGrade)
    {
        $form = $this->createDeleteForm($niveauGrade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($niveauGrade);
            $em->flush();
        }

        return $this->redirectToRoute('niveaugrade_index');
    }

    /**
     * Creates a form to delete a niveauGrade entity.
     *
     * @param NiveauGrade $niveauGrade The niveauGrade entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(NiveauGrade $niveauGrade)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('niveaugrade_delete', array('id' => $niveauGrade->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
