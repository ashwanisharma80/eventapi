<?php

namespace DroidInfotech\DroidBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DroidInfotech\DroidBundle\Entity\UserFavourite;
use DroidInfotech\DroidBundle\Form\UserFavouriteType;

/**
 * UserFavourite controller.
 *
 * @Route("/userfavourite")
 */
class UserFavouriteController extends Controller {

    /**
     * Lists all UserFavourite entities.
     *
     * @Route("/", name="userfavourite_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $userFavourites = $em->getRepository('DroidInfotechDroidBundle:UserFavourite')->findAll();

        return $this->render('userfavourite/index.html.twig', array(
                    'userFavourites' => $userFavourites,
        ));
    }

    /**
     * Creates a new UserFavourite entity.
     *
     * @Route("/new", name="userfavourite_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $userFavourite = new UserFavourite();
        $form = $this->createForm('DroidInfotech\DroidBundle\Form\UserFavouriteType', $userFavourite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userFavourite);
            $em->flush();

            return $this->redirectToRoute('userfavourite_show', array('id' => $userFavourite->getId()));
        }

        return $this->render('userfavourite/new.html.twig', array(
                    'userFavourite' => $userFavourite,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserFavourite entity.
     *
     * @Route("/{id}", name="userfavourite_show")
     * @Method("GET")
     */
    public function showAction(UserFavourite $userFavourite) {
        $deleteForm = $this->createDeleteForm($userFavourite);

        return $this->render('userfavourite/show.html.twig', array(
                    'userFavourite' => $userFavourite,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UserFavourite entity.
     *
     * @Route("/{id}/edit", name="userfavourite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserFavourite $userFavourite) {
        $deleteForm = $this->createDeleteForm($userFavourite);
        $editForm = $this->createForm('DroidInfotech\DroidBundle\Form\UserFavouriteType', $userFavourite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userFavourite);
            $em->flush();

            return $this->redirectToRoute('userfavourite_edit', array('id' => $userFavourite->getId()));
        }

        return $this->render('userfavourite/edit.html.twig', array(
                    'userFavourite' => $userFavourite,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a UserFavourite entity.
     *
     * @Route("/{id}", name="userfavourite_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserFavourite $userFavourite) {
        $form = $this->createDeleteForm($userFavourite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userFavourite);
            $em->flush();
        }

        return $this->redirectToRoute('userfavourite_index');
    }

    /**
     * Creates a form to delete a UserFavourite entity.
     *
     * @param UserFavourite $userFavourite The UserFavourite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserFavourite $userFavourite) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('userfavourite_delete', array('id' => $userFavourite->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    /* User Favourite Add Webservice */

    public function addUserFavouriteAction(Request $request) {
        $token = $request->request->get("token");
        $userId = $request->request->get("userId");
        $exhibitor_id = $request->request->get("exhibitor_id");
        $favourite = $request->request->get("favourite");
        $userdata = $request->getSession()->get('userdata');

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('DroidInfotechDroidBundle:Log')->findByUserToken($token);
        $status_code = 0;
        $message = "No Record Found";
        $data = array();
        if (!$users) {
            $status_code = 0;
            $message = "Not Valid Token";
            $data = array();
        } else {


            $dql = "SELECT ev.id 
                  FROM DroidInfotechDroidBundle:UserFavourite ev
                    WHERE ev.userId='" . $userId . "' and ev.exhibitorId='" . $exhibitor_id . "'";

            $result = $em->createQuery($dql)->getResult();
            if ($result) {
                $status_code = 1;
                $message = "Updated Successfully !";
                $qb = $em->createQueryBuilder();
                $q = $qb->update('DroidInfotech\DroidBundle\Entity\UserFavourite', 'u')
                        ->set('u.userId', '?1')
                        ->set('u.exhibitorId', '?2')
                        ->set('u.favourite', '?3')
                        ->set('u.createdOn', '?4')
                        ->where('u.userId = ?5 and u.exhibitorId = ?6')
                        ->setParameter(1, $userId)
                        ->setParameter(2, $exhibitor_id)
                        ->setParameter(3, $favourite)
                        ->setParameter(4, new \DateTime())
                        ->setParameter(5, $userId)
                        ->setParameter(6, $exhibitor_id)
                        ->getQuery();
                $p = $q->execute();
                $em->flush();
                $data=array('favouriteflag'=>$favourite);
            } else {
                $status_code = 1;
                $message = "Updated Successfully !";
                $UserFavourite = new UserFavourite();
                $UserFavourite->setUserId($userId);
                $UserFavourite->setExhibitorId($exhibitor_id);
                $UserFavourite->setFavourite($favourite);
                $UserFavourite->setCreatedOn(new \DateTime());
                 $em->persist($UserFavourite);
                $em->flush();
                $data=array('favouriteflag'=>$favourite);
            }
        }
        $json = json_encode(array(
            'message' => $message,
            'data' => $data,
            'status_code' => $status_code
                ), JSON_UNESCAPED_SLASHES);
        return new Response($json, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'application/json'));
    }

}
