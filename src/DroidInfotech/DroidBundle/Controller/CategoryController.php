<?php

namespace DroidInfotech\DroidBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DroidInfotech\DroidBundle\Entity\Category;
use DroidInfotech\DroidBundle\Form\CategoryType;

/**
 * Category controller.
 *
 * @Route("/category")
 */
class CategoryController extends Controller {

    /**
     * Lists all Category entities.
     *
     * @Route("/", name="category_index")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        if (empty($request->getSession()->get('token'))) {
            return $this->redirectToRoute('check_path');
        }
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('DroidInfotechDroidBundle:Category')->findAll();

        return $this->render('category/index.html.twig', array(
                    'categories' => $categories,
        ));
    }

    /**
     * Creates a new Category entity.
     *
     * @Route("/new", name="category_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        if (empty($request->getSession()->get('token'))) {
            return $this->redirectToRoute('check_path');
        }
        $category = new Category();
        $form = $this->createForm('DroidInfotech\DroidBundle\Form\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setCreatedOn(new \DateTime("now"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('category_index');
            return $this->redirectToRoute('category_show', array('id' => $category->getId()));
        }

        return $this->render('category/new.html.twig', array(
                    'category' => $category,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Category entity.
     *
     * @Route("/{id}", name="category_show")
     * @Method("GET")
     */
    public function showAction(Category $category, Request $request) {
        if (empty($request->getSession()->get('token'))) {
            return $this->redirectToRoute('check_path');
        }
        $deleteForm = $this->createDeleteForm($category);

        return $this->render('category/show.html.twig', array(
                    'category' => $category,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Category entity.
     *
     * @Route("/{id}/edit", name="category_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Category $category) {
        if (empty($request->getSession()->get('token'))) {
            return $this->redirectToRoute('check_path');
        }
        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('DroidInfotech\DroidBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('category_index');
            return $this->redirectToRoute('category_edit', array('id' => $category->getId()));
        }

        return $this->render('category/edit.html.twig', array(
                    'category' => $category,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Category entity.
     *
     * @Route("/{id}/remove", name="category_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Category $category) {
        if (empty($request->getSession()->get('token'))) {
            return $this->redirectToRoute('check_path');
        }
        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);       
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('category_index');
    }

    /**
     * Creates a form to delete a Category entity.
     *
     * @param Category $category The Category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Category $category) {
       
        return $this->createFormBuilder(array(),array('csrf_token_id' =>'authenticate'))
                        ->setAction($this->generateUrl('category_delete', array('id' => $category->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    /* Category List Webservice */

    public function productCategoryListAction(Request $request) {
        $token = $request->request->get("token");
        $userdata = $request->getSession()->get('userdata');
        $eventId = $request->request->get('eventId');
        
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

            $em = $this->getDoctrine()->getManager();

            $dql = "SELECT cat.id,cat.name
                  FROM category cat
                  INNER JOIN exhibitor_category ec on ec.category_id=cat.id
                  INNER JOIN exhibitor exh on exh.id=ec.exhibitor_id
                  INNER JOIN events_exhibitor ee on ee.exhibitor_id=exh.id AND ee.events_id = '{$eventId}' 
                    WHERE cat.active=1 and exh.active=1 group by ec.category_id order by cat.name asc
                  ";

            $results = $em->getConnection()->prepare($dql);
            $results->execute();
            $result = $results->fetchAll();


            if ($result) {
                $status_code = 1;
                $message = "Product Category List";
                $data = $result;
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
