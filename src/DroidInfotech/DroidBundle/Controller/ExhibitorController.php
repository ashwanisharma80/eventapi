<?php

namespace DroidInfotech\DroidBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DroidInfotech\DroidBundle\Entity\Exhibitor;
use DroidInfotech\DroidBundle\Form\ExhibitorType;
use DroidInfotech\DroidBundle\Entity\UserFavourite;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


/**
 * exhibitor controller.
 *
 * @Route("/exhibitor")
 */
class ExhibitorController extends Controller {

    /**
     * Lists all exhibitor entities.
     *
     * @Route("/", name="exhibitor_index")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        if (empty($request->getSession()->get('token'))) {
            return $this->redirectToRoute('check_path');
        }
        $exhibitor = new Exhibitor();
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT a FROM DroidInfotechDroidBundle:Exhibitor a  ";
        $form = $this->createForm('DroidInfotech\DroidBundle\Form\ExhibitorType', $exhibitor);
        $form->handleRequest($request);
        if ($request->isMethod('POST')) {

            $dqls = array();
            if ($exhibitor->getName()) {
                $dqls[] = " a.name like '" . $exhibitor->getName() . "%'";
            }
            if ($exhibitor->getLocation()) {
                $dqls[] = " a.location like '" . $exhibitor->getLocation() . "%'";
            }
            if (!empty($dqls)) {
                $dql .= " where " . implode(" AND ", $dqls);
            }
        }
        // echo $dql;
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('exhibitor/index.html.twig', array(
                    'pagination' => $pagination,
                    'form' => $form->createView()
        ));
    }

    /**
     * Creates a new exhibitor entity.
     *
     * @Route("/new", name="exhibitor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        if (empty($request->getSession()->get('token'))) {
            return $this->redirectToRoute('check_path');
        }
        $error = array();
        $exhibitor = new exhibitor();
        $form = $this->createForm('DroidInfotech\DroidBundle\Form\ExhibitorType', $exhibitor);
        $form->handleRequest($request);
        $allowed_ext = $this->getParameter('allowedExt');
        $exhibitor_image_dir = $this->getParameter('exhibitor_image_dir');
        $flg = false;
        if ($form->isSubmitted() && $form->isValid()) {
            $forms = $request->request->get('exhibitor');
            $name = $forms['name'];

            $em = $this->getDoctrine()->getManager();
            $exhibitors = $em->getRepository('DroidInfotechDroidBundle:Exhibitor')->findOneBy(array('name' => $name));
            if ($exhibitors) {
                $error[] = "Exhibitor already registered";
            }
            if (!empty($_FILES['exhibitor']['name']['logo'])) {
                $extension = @end(explode(".", $_FILES['exhibitor']['name']['logo']));

                if (!in_array($extension, $allowed_ext)) {
                    $flg = true;
                }
            }
            if (isset($_FILES['exhibitor']['name']['eventshowcaseimage']) && !empty($_FILES['exhibitor']['name']['eventshowcaseimage'])) {
                $pdfextension = @end(explode(".", $_FILES['exhibitor']['name']['eventshowcaseimage']));
                if (!in_array($pdfextension, $allowed_ext)) {
                    $flg = true;
                }
            }
            if (isset($_FILES['exhibitor']['name']['image']) && !empty($_FILES['exhibitor']['name']['image'])) {
                $pdfextension = @end(explode(".", $_FILES['exhibitor']['name']['image']));
                if (!in_array($pdfextension, $allowed_ext)) {
                    $flg = true;
                }
            }
            if ($flg) {
                $error[] = "Only " . @implode(",", $allowed_ext) . " allowed !";
            }

            if (empty($error)) {

                $exhibitor->setCreatedOn(new \DateTime("now"));
                $em->persist($exhibitor);
                $em->flush();
                if (!empty($_FILES['exhibitor'])) {
                    $tmpeventshowcaseimage = "";
                    $logoimage = "";
                    $eventshowcaseimage = "";
                    if (isset($_FILES['exhibitor']['name']['logo']) && !empty($_FILES['exhibitor']['name']['logo'])) {
                        $extension = @end(explode(".", $_FILES['exhibitor']['name']['logo']));
                        if (in_array($extension, $allowed_ext)) {
                            $logoimage = md5(uniqid()) . "_" . $exhibitor->getId() . "." . $extension;
                            move_uploaded_file($_FILES['exhibitor']['tmp_name']['logo'], $exhibitor_image_dir . '/' . $logoimage);
                            $qb = $em->createQueryBuilder();
                            $q = $qb->update('DroidInfotech\DroidBundle\Entity\Exhibitor', 'u')
                                    ->set('u.logo', '?2')
                                    ->where('u.id = ?1')
                                    ->setParameter(2, 'web/uploads/exhibitorimages/' . $logoimage)
                                    ->setParameter(1, $exhibitor->getId())
                                    ->getQuery();
                            $p = $q->execute();
                            $em->flush();
                        }
                    }
                    if (isset($_FILES['exhibitor']['name']['image']) && !empty($_FILES['exhibitor']['name']['image'])) {

                        $extension = @end(explode(".", $_FILES['exhibitor']['name']['image']));
                        if (in_array($extension, $allowed_ext)) {
                            $imagename = md5(uniqid()) . "_" . $exhibitor->getId() . "." . $extension;

                            move_uploaded_file($_FILES['exhibitor']['tmp_name']['image'], $exhibitor_image_dir . '/' . $imagename);
                            $qb = $em->createQueryBuilder();
                            $q = $qb->update('DroidInfotech\DroidBundle\Entity\Exhibitor', 'u')
                                    ->set('u.image', '?3')
                                    ->where('u.id = ?1')
                                    ->setParameter(3, 'web/uploads/exhibitorimages/' . $imagename)
                                    ->setParameter(1, $exhibitor->getId())
                                    ->getQuery();
                            $p = $q->execute();
                            $em->flush();
                        }
                    }
                    if (isset($_FILES['exhibitor']['name']['eventshowcaseimage']) && !empty($_FILES['exhibitor']['name']['eventshowcaseimage'])) {
                        $extension = @end(explode(".", $_FILES['exhibitor']['name']['eventshowcaseimage']));
                        if (in_array($extension, $allowed_ext)) {
                            $eventshowcaseimage = md5(uniqid()) . "_" . $exhibitor->getId() . "." . $extension;
                            move_uploaded_file($_FILES['exhibitor']['tmp_name']['eventshowcaseimage'], $exhibitor_image_dir . '/' . $eventshowcaseimage);
                            $qb = $em->createQueryBuilder();
                            $q = $qb->update('DroidInfotech\DroidBundle\Entity\Exhibitor', 'u')
                                    ->set('u.eventshowcaseimage', '?4')
                                    ->where('u.id = ?1')
                                    ->setParameter(4, 'web/uploads/exhibitorimages/' . $eventshowcaseimage)
                                    ->setParameter(1, $exhibitor->getId())
                                    ->getQuery();
                            $p = $q->execute();
                            $em->flush();
                        }
                    }
                }

                return $this->redirectToRoute('exhibitor_index', array('id' => $exhibitor->getId()));
            }
        }

        return $this->render('exhibitor/new.html.twig', array(
                    'exhibitor' => $exhibitor,
                    'form' => $form->createView(),
                    'error' => implode(",", $error)
        ));
    }

    /**
     * Displays a form to edit an existing exhibitor entity.
     *
     * @Route("/{id}/edit", name="exhibitor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, exhibitor $exhibitor) {
        if (empty($request->getSession()->get('token'))) {
            return $this->redirectToRoute('check_path');
        }
        $deleteForm = $this->createDeleteForm($exhibitor);
        $editForm = $this->createForm('DroidInfotech\DroidBundle\Form\ExhibitorType', $exhibitor);
        $editForm->handleRequest($request);
        $allowed_ext = $this->getParameter('allowedExt');
        $exhibitor_image_dir = $this->getParameter('exhibitor_image_dir');
        $flg = false;
        $error = array();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $forms = $request->request->get('exhibitor');
            $name = $forms['name'];
            $em = $this->getDoctrine()->getManager();
            $exhibitors = $em->getRepository('DroidInfotechDroidBundle:Exhibitor')->findBy(array('name' => $name));
            $flg = false;
            if ($exhibitors) {
                foreach ($exhibitors as $exhibitorss) {
                    if ($exhibitorss->getId() != $exhibitor->getId()) {
                        $flg = true;
                        break;
                    }
                }
                if ($flg) {
                    $error[] = "Exhibitor already registered";
                }
            }
            $flg = false;
            if (!empty($_FILES['exhibitor']['name']['logo'])) {
                $extension = @end(explode(".", $_FILES['exhibitor']['name']['logo']));
                if ($extension <> "") {
                    if (!in_array($extension, $allowed_ext)) {
                        $flg = true;
                    }
                }
            }
            if (isset($_FILES['exhibitor']['name']['eventshowcaseimage']) && !empty($_FILES['exhibitor']['name']['eventshowcaseimage'])) {
                $pdfextension = @end(explode(".", $_FILES['exhibitor']['name']['eventshowcaseimage']));
                if (!in_array($pdfextension, $allowed_ext)) {
                    $flg = true;
                }
            }
            if (isset($_FILES['exhibitor']['name']['image']) && !empty($_FILES['exhibitor']['name']['image'])) {
                $pdfextension = @end(explode(".", $_FILES['exhibitor']['name']['image']));

                if (!in_array($pdfextension, $allowed_ext)) {
                    $flg = true;
                }
            }

            if ($flg) {
                $error[] = "Only " . @implode(",", $allowed_ext) . " allowed !";
            }

            if (empty($error)) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($exhibitor);
                $em->flush();
                if (!empty($_FILES['exhibitor'])) {
                    $tmpeventshowcaseimage = "";
                    $logoimage = "";
                    $eventshowcaseimage = "";

                    // foreach ($_FILES['exhibitor'] as $key => $val) {
                    if (isset($_FILES['exhibitor']['name']['logo']) && !empty($_FILES['exhibitor']['name']['logo'])) {
                        $extension = @end(explode(".", $_FILES['exhibitor']['name']['logo']));
                        if (in_array($extension, $allowed_ext)) {
                            $logoimage = md5(uniqid()) . "_" . $exhibitor->getId() . "." . $extension;
                            move_uploaded_file($_FILES['exhibitor']['tmp_name']['logo'], $exhibitor_image_dir . '/' . $logoimage);
                            $qb = $em->createQueryBuilder();
                            $q = $qb->update('DroidInfotech\DroidBundle\Entity\Exhibitor', 'u')
                                    ->set('u.logo', '?2')
                                    ->where('u.id = ?1')
                                    ->setParameter(2, 'web/uploads/exhibitorimages/' . $logoimage)
                                    ->setParameter(1, $exhibitor->getId())
                                    ->getQuery();
                            $p = $q->execute();
                            $em->flush();
                        }
                    }
                    if (isset($_FILES['exhibitor']['name']['image']) && !empty($_FILES['exhibitor']['name']['image'])) {

                        $extension = @end(explode(".", $_FILES['exhibitor']['name']['image']));
                        if (in_array($extension, $allowed_ext)) {
                            $imagename = md5(uniqid()) . "_" . $exhibitor->getId() . "." . $extension;

                            move_uploaded_file($_FILES['exhibitor']['tmp_name']['image'], $exhibitor_image_dir . '/' . $imagename);
                            $qb = $em->createQueryBuilder();
                            $q = $qb->update('DroidInfotech\DroidBundle\Entity\Exhibitor', 'u')
                                    ->set('u.image', '?3')
                                    ->where('u.id = ?1')
                                    ->setParameter(3, 'web/uploads/exhibitorimages/' . $imagename)
                                    ->setParameter(1, $exhibitor->getId())
                                    ->getQuery();
                            $p = $q->execute();
                            $em->flush();
                        }
                    }
                    if (isset($_FILES['exhibitor']['name']['eventshowcaseimage']) && !empty($_FILES['exhibitor']['name']['eventshowcaseimage'])) {
                        $extension = @end(explode(".", $_FILES['exhibitor']['name']['eventshowcaseimage']));

                        if (in_array($extension, $allowed_ext)) {
                            $eventshowcaseimage = md5(uniqid()) . "_" . $exhibitor->getId() . "." . $extension;
                            move_uploaded_file($_FILES['exhibitor']['tmp_name']['eventshowcaseimage'], $exhibitor_image_dir . '/' . $eventshowcaseimage);
                            $qb = $em->createQueryBuilder();
                            $q = $qb->update('DroidInfotech\DroidBundle\Entity\Exhibitor', 'u')
                                    ->set('u.eventshowcaseimage', '?4')
                                    ->where('u.id = ?1')
                                    ->setParameter(4, 'web/uploads/exhibitorimages/' . $eventshowcaseimage)
                                    ->setParameter(1, $exhibitor->getId())
                                    ->getQuery();
                            $p = $q->execute();
                            $em->flush();
                        }
                    }

                    //     }
                }

                return $this->redirectToRoute('exhibitor_index');
            }
        }

        return $this->render('exhibitor/edit.html.twig', array(
                    'exhibitor' => $exhibitor,
                    'error' => implode(",", $error),
                    'form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a exhibitor entity.
     *
     * @Route("/delete/{id}", name="exhibitor_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, exhibitor $exhibitor) {
        if (empty($request->getSession()->get('token'))) {
            return $this->redirectToRoute('check_path');
        }
        if ($exhibitor->getId() > 0) {
            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('DroidInfotechDroidBundle:Exhibitor')->findById($exhibitor->getId());
            foreach ($result as $result) {
                if (file_exists($this->getParameter('exhibitor_image_dir') . str_replace("web/uploads/exhibitorimages", "", $result->getLogo()))) {
                    @unlink($this->getParameter('exhibitor_image_dir') . str_replace("web/uploads/exhibitorimages", "", $result->getLogo()));
                }
                if (file_exists($this->getParameter('exhibitor_image_dir') . str_replace("web/uploads/exhibitorimages", "", $result->getImage()))) {
                    @unlink($this->getParameter('exhibitor_image_dir') . str_replace("web/uploads/exhibitorimages", "", $result->getImage()));
                }
                if (file_exists($this->getParameter('exhibitor_image_dir') . str_replace("web/uploads/exhibitorimages", "", $result->getEventshowcaseimage()))) {
                    @unlink($this->getParameter('exhibitor_image_dir') . str_replace("web/uploads/exhibitorimages", "", $result->getEventshowcaseimage()));
                }
            }
            $queryBuilder = $em
                    ->createQueryBuilder()
                    ->delete('DroidInfotechDroidBundle:Exhibitor', 'a')
                    ->where('a.id = :parent')
                    ->setParameter('parent', $exhibitor->getId());
            $queryBuilder->getQuery()->execute();

            return $this->redirectToRoute('exhibitor_index');
        }
    }

    /**
     * Creates a form to delete a exhibitor entity.
     *
     * @param exhibitor $exhibitor The exhibitor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(exhibitor $exhibitor) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('exhibitor_delete', array('id' => $exhibitor->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    /** ExihibitorList for event* */
    public function exihibitorListForEventAction(Request $request) {
        $token = $request->request->get("token");
        $eventId = $request->request->get('eventId');
        $showcaselist = $request->request->get('showcaselist');
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
            /** Results * */
            if ($showcaselist == 2) {
                $dql = "SELECT ev.id as exhibitor_id,ev.name,ev.contact_number,ev.location,ev.logo,group_concat(ec.category_id) as categoryId,
                    ev.event_showcase,ev.eventshowcase_info,ev.eventshowcaseimage
                    FROM exhibitor ev
                    INNER JOIN events_exhibitor ee ON ee.exhibitor_id = ev.id and ee.events_id = '{$eventId}'
                    LEFT JOIN exhibitor_category ec on ec.exhibitor_id=ev.id
                    WHERE ev.active=1 and ev.event_showcase=1  group by ev.id order by ev.name asc";
            } else {
                $dql = "SELECT ev.id as exhibitor_id,ev.name,ev.contact_number,ev.location,ev.logo,group_concat(ec.category_id) as categoryId
                    FROM exhibitor ev
                    INNER JOIN events_exhibitor ee ON ee.exhibitor_id = ev.id and ee.events_id = '{$eventId}'
                    LEFT JOIN exhibitor_category ec on ec.exhibitor_id=ev.id
                    WHERE ev.active=1 group by ev.id order by ev.name asc";
            }

            $result = $em->getConnection()->prepare($dql);
            $result->execute();
            $results = $result->fetchAll();


            if ($results) {
                $status_code = 1;
                $message = "Exhibitor List";
                $data = $results;
            }
        }
        $json = json_encode(array(
            'message' => $message,
            'data' => $data,
            'status_code' => $status_code
                ), JSON_UNESCAPED_SLASHES);
        return new Response($json, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'application/json'));
    }

    /* Exhibitor List Webservice */

    public function exihibitorListAction(Request $request) {
        $content = $this->getContentAsArray($request);
        // $request->request=$content;
       // $username = $content["token"];
        $token =$content["token"];// $request->request->get("token");
       // $userdata = $request->getSession()->get('userdata');
        $showcaselist = 2; // $request->request->get('showcaselist');
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
            if ($showcaselist == 2) {
                $dql = "SELECT ev.id as exhibitor_id,ev.name,ev.contact_number,ev.location,ev.logo,group_concat(ec.category_id) as categoryId,
                    ev.event_showcase,ev.eventshowcase_info,ev.eventshowcaseimage
                  FROM exhibitor ev
                  LEFT JOIN exhibitor_category ec on ec.exhibitor_id=ev.id
                    WHERE ev.active=1 and ev.event_showcase=1  group by ev.id order by ev.name asc
                  ";
            } else {
                $dql = "SELECT ev.id as exhibitor_id,ev.name,ev.contact_number,ev.location,ev.logo,group_concat(ec.category_id) as categoryId
                  FROM exhibitor ev
                  LEFT JOIN exhibitor_category ec on ec.exhibitor_id=ev.id
                    WHERE ev.active=1 group by ev.id order by ev.name asc
                  ";
            }
            
            $result = $em->getConnection()->prepare($dql);
            $result->execute();
            $results = $result->fetchAll();

            if ($results) {
                $status_code = 1;
                $message = "Exhibitor List";
                $data = $results;
            }
        }
        $json = json_encode(array(
            'message' => $message,
            'data' => $data,
            'status_code' => $status_code
                ), JSON_UNESCAPED_SLASHES);
        return new Response($json, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'application/json'));
    }

    /* Exhibitor Detail Webservice */

    public function exihibitorDetailAction(Request $request) {
        $token = $request->request->get("token");
        $exhibitor_id = $request->request->get("exhibitor_id");
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
        } else if (trim($exhibitor_id) != "") {

            $em = $this->getDoctrine()->getManager();
            $dql = "SELECT ev.*,uf.favourite
                  FROM exhibitor ev
                  LEFT JOIN  user_favourite uf ON uf.exhibitor_id=ev.id AND uf.user_id='" . $users[0]->getUserId() . "' and uf.exhibitor_id='" . $exhibitor_id . "'
                    WHERE 
                     ev.active=1 and ev.id='" . $exhibitor_id . "'
                  ";

            $result = $em->getConnection()->prepare($dql);
            $result->execute();
            $results = $result->fetchAll();


            if ($results) {

                $status_code = 1;
                $message = "Exhibitor Details";
                $data = $results;

                // $data['favourite']=0;
            }
        }
        $json = json_encode(array(
            'message' => $message,
            'data' => $data,
            'status_code' => $status_code
                ), JSON_UNESCAPED_SLASHES);
        return new Response($json, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'application/json'));
    }

    /* user exhibitor favourite list */

    public function UserfavouriteListAction(Request $request) {
        $token = $request->request->get("token");
        $userId = $request->request->get("userId");
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
        } else if (trim($userId) != "") {

            $em = $this->getDoctrine()->getManager();
            $dql = "SELECT ev.exhibitorId 
                  FROM DroidInfotechDroidBundle:UserFavourite ev
                    WHERE ev.userId='" . $userId . "' and ev.favourite=1";

            $result = $em->createQuery($dql)->getResult();

            if ($result) {
                $exhibitorId = '';
                foreach ($result as $results) {
                    $exhibitorId .= $results['exhibitorId'] . ",";
                }
                $exhibitorId = rtrim($exhibitorId, ",");
                $dql = "SELECT ev.id as exhibitor_id,ev.name,ev.contactNumber,ev.location,ev.logo,
                ev.boothno,ev.emailAdd,ev.url,ev.productDesc,ev.eventShowcase,ev.eventshowcaseInfo,ev.eventshowcaseimage,ev.Facebooklink,ev.Youtubelink,
                ev.Instagram,ev.Twiterlink
                  FROM DroidInfotechDroidBundle:Exhibitor ev
                    WHERE ev.active=1 and ev.id in(" . $exhibitorId . ")  
                  ";

                $result = $em->createQuery($dql)->getResult();
                $status_code = 1;
                $message = "User Favourite Exhibitor List";
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

    protected function getContentAsArray(Request $request) {
        $content = $request->getContent();
        if (empty($content)) {
            throw new BadRequestHttpException("Content is empty");
        }
        return new ArrayCollection(json_decode($content, true));
    }

}
