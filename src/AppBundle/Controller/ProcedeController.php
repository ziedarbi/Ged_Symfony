<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MethodeDispline;
use AppBundle\Entity\Procede;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Procede controller.
 *
 * @Route("procede")
 */
class ProcedeController extends Controller
{
    /**
     * Lists all procede entities.
     *
     * @Route("/", name="procede_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $procedes = $em->getRepository('AppBundle:Procede')->findAll();

        return $this->render('procede/index.html.twig', array(
            'procedes' => $procedes,
        ));
    }


    /**
     * Lists all niveauGrade entities.
     *
     * @Route("/findprocede/{idMethode}", name="findprocede")
     * @Method({"POST","GET"})
     */
    public function findprocedeAction(MethodeDispline $idMethode)
    {
        $em = $this->getDoctrine()->getManager();

        $procede = $em->getRepository('AppBundle:Procede')->findby(array('idmethodedisp'=>$idMethode));

        return new JsonResponse($procede);


    }
    /**
     * Creates a new procede entity.
     *
     * @Route("/new", name="procede_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $procede = new Procede();
        $form = $this->createForm('AppBundle\Form\ProcedeType', $procede);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($procede);
            $em->flush();

            return $this->redirectToRoute('procede_show', array('id' => $procede->getId()));
        }

        return $this->render('procede/new.html.twig', array(
            'procede' => $procede,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a procede entity.
     *
     * @Route("/{id}", name="procede_show")
     * @Method("GET")
     */
    public function showAction(Procede $procede)
    {
        $deleteForm = $this->createDeleteForm($procede);

        return $this->render('procede/show.html.twig', array(
            'procede' => $procede,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing procede entity.
     *
     * @Route("/{id}/edit", name="procede_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Procede $procede)
    {
        $deleteForm = $this->createDeleteForm($procede);
        $editForm = $this->createForm('AppBundle\Form\ProcedeType', $procede);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('procede_edit', array('id' => $procede->getId()));
        }

        return $this->render('procede/edit.html.twig', array(
            'procede' => $procede,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a procede entity.
     *
     * @Route("/{id}", name="procede_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Procede $procede)
    {
        $form = $this->createDeleteForm($procede);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($procede);
            $em->flush();
        }

        return $this->redirectToRoute('procede_index');
    }

    /**
     * Creates a form to delete a procede entity.
     *
     * @param Procede $procede The procede entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Procede $procede)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('procede_delete', array('id' => $procede->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
