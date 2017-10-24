<?php

namespace DroidInfotech\DroidBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DroidInfotech\DroidBundle\Entity\Notification_message;
use DroidInfotech\DroidBundle\Form\Notification_messageType;

/**
 * Notification_message controller.
 *
 * @Route("/notification_message")
 */
class Notification_messageController extends Controller {

    /**
     * Lists all Notification_message entities.
     *
     * @Route("/", name="notification_message_index")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $notification_messages = new Notification_message();
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT a FROM DroidInfotechDroidBundle:Notification_message a ";
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('notification_message/index.html.twig', array(
                    'pagination' => $pagination,
                    'form' => ''
        ));
    }

    /**
     * Creates a new Notification_message entity.
     *
     * @Route("/new", name="notification_message_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $notification_message = new Notification_message();
        $form = $this->createForm('DroidInfotech\DroidBundle\Form\Notification_messageType', $notification_message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message = $_REQUEST['notification_message']['message'];
            $em = $this->getDoctrine()->getManager();
            $notification_message->setMessage($message);
            $notification_message->setCreatedOn(new \DateTime());
            $notification_message->setUserId($this->getUser()->getId());
            $em->persist($notification_message);
            $em->flush();
            return $this->redirectToRoute('notification_message_index');
            // return $this->redirectToRoute('notification_message_show', array('id' => $notification_message->getId()));
        }

        return $this->render('notification_message/new.html.twig', array(
                    'notification_message' => $notification_message,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Notification_message entity.
     *
     * @Route("/{id}", name="notification_message_show")
     * @Method("GET")
     */
    public function showAction(Notification_message $notification_message) {
        $deleteForm = $this->createDeleteForm($notification_message);

        return $this->render('notification_message/show.html.twig', array(
                    'notification_message' => $notification_message,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Notification_message entity.
     *
     * @Route("/{id}/edit", name="notification_message_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Notification_message $notification_message) {
        $deleteForm = $this->createDeleteForm($notification_message);
        $editForm = $this->createForm('DroidInfotech\DroidBundle\Form\Notification_messageType', $notification_message);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $message = $_REQUEST['notification_message']['message'];
            $notification_message->setMessage($message);
            $notification_message->setCreatedOn(new \DateTime());
            $notification_message->setUserId($this->getUser()->getId());
            $em->persist($notification_message);
            $em->flush();

            return $this->redirectToRoute('notification_message_index');
        }

        return $this->render('notification_message/edit.html.twig', array(
                    'notification_message' => $notification_message,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Notification_message entity.
     *
     * @Route("/delete/{id}", name="notification_message_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Notification_message $notification_message) {
        $form = $this->createDeleteForm($notification_message);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $em->remove($notification_message);
        $em->flush();


        return $this->redirectToRoute('notification_message_index');
    }

    /**
     * Creates a form to delete a Notification_message entity.
     *
     * @param Notification_message $notification_message The Notification_message entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Notification_message $notification_message) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('notification_message_delete', array('id' => $notification_message->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    /**
     * Displays a form to edit an existing Notification_message entity.
     *
     * @Route("/{id}/send", name="notification_message_send")
     * @Method({"GET", "POST"})
     */
    public function sendMessageAction(Request $request, $id) {
        if ($id > 0) {
            $pushobj = $this->get('Pushnotification');
            $notification_messages = new Notification_message();
            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('DroidInfotechDroidBundle:Notification_message')->findBy(array('id' => $id, 'active' => 1));
            $desc = '';
            if ($result) {
                foreach ($result as $result) {
                    $desc = $result->getMessage();
                }

                if ($desc <> "") {
                    $results = $em->getRepository('DroidInfotechDroidBundle:Device')->findAll();
                    if ($results) {
                        foreach ($results as $results) {
                            if ($results->getDevicetype() == 'android') {
                                $result = $pushobj->android(array("mdesc" => $desc, "mtitle" => "Off-Road Expo"), $results->getDevicetoken());
                            }else if ($results->getDevicetype() == 'iOS') {
                                 $result = $pushobj->iOS(array("mdesc" => $desc, "mtitle" => "Off-Road Expo"), $results->getDevicetoken(),1);
                            }
                        }
                    }
                }
            }
        }
        $this->addFlash(
                'notice', 'Message has been sent !'
        );
        //return new Response();
       return $this->redirectToRoute('notification_message_index');
    }

}
