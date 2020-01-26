<?php
 
namespace AppBundle\Controller;

use AppBundle\Entity\Machine;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Utils\GestionProd;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use FOS\UserBundle\Doctrine\UserManager;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
class AdminController extends Controller
{



    /**
     * @Route("/admin/ListeUtilisateurs", name="ListeUtilisateurs")
     */
    public function ListeUtilisateursAction(Request $request)
    {
        // replace this example code with whatever you need
        $users = $this->getDoctrine()->getManager()->getRepository('AppBundle:User')->findAll();
//var_dump($users);
        return $this->render('Admin/listeutilisateurs.twig',array('users' => $users ));
    }

    /**
     * @Route("/admin/afficherUtilisateur/{id}", name="afficherUtilisateur")
     *
     */
    public function afficherUtilisateurAction( Request $request,User $user)
    {

        //   $deleteForm = $this->createDeleteForm($machine);

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->find($user->getId());

        return $this->render('Admin/AfficherMember.html.twig', array(
            'user' => $user,

            //  'delete_form' => $deleteForm->createView(),
        ));

    }




    /**
     * @Route("/admin/modifierUtilisateur/{id}", name="modifierUtilisateur")
     *
     */
    public function modifierUtilisateurAction( Request $request,User $user)
    {

     //  $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('AppBundle\Form\RegistrationType', $user);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($editForm->isSubmitted() && $editForm->isValid()) {


            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'la  modification se fait avec succèe ');
          return $this->render('Admin/AfficherMember.html.twig',array('user' => $user));
        }

        return $this->render('Admin/editRoleMember.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            //'delete_form' => $deleteForm->createView(),
        ));
            }
    /**
     * @Route("/admin/deleteUser/{id}", name="deleteUser")
     *
     */

    public function deleteUserAction(User $user){
        $userManager =$this->container->get('fos_user.user_manager');
        $userManager->deleteUser($user);
        return $this->redirectToRoute('ListeUtilisateurs');
    }


}
