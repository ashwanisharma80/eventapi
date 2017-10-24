<?php

namespace DroidInfotech\DroidBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DroidInfotech\DroidBundle\Entity\Maps;
use DroidInfotech\DroidBundle\Form\MapsType;

/**
 * Maps controller.
 *
 * @Route("/maps")
 */
class MapsController extends Controller {

   /**
    * Lists all Maps entities.
    *
    * @Route("/", name="maps_index")
    * @Method("GET")
    */
   public function indexAction(Request $request) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $Maps = new Maps();
      $em = $this->getDoctrine()->getManager();
      $dql = "SELECT a  FROM DroidInfotechDroidBundle:Maps a  ";
      $form = $this->createForm('DroidInfotech\DroidBundle\Form\MapsType', $Maps);
      $form->handleRequest($request);
      if ($request->isMethod('POST')) {

         $dqls = array();
         if ($Maps->getTitle()) {
            $dqls[] = " a.name like '" . $Maps->getTitle() . "%'";
         }
         if (!empty($dqls)) {
            $dql.= " where " . implode(" AND ", $dqls);
         }
      }
      // echo $dql;
      $query = $em->createQuery($dql);
      $paginator = $this->get('knp_paginator');
      $pagination = $paginator->paginate(
              $query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
              , array('distinct' => false));
      return $this->render('maps/index.html.twig', array(
                  'pagination' => $pagination,
                  'form' => $form->createView()
      ));
   }

   /**
    * Creates a new Maps entity.
    *
    * @Route("/new", name="maps_new")
    * @Method({"GET", "POST"})
    */
   public function newAction(Request $request) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $allowedpdf_ext = array('pdf', 'PDF');
      $allowed_ext = $this->getParameter('allowedExt');
      $map_image_dir = $this->getParameter('map_image_dir');
      $map = new Maps();
      $form = $this->createForm('DroidInfotech\DroidBundle\Form\MapsType', $map);
      $form->handleRequest($request);
      $error = array();
      if ($form->isSubmitted() && $form->isValid()) {
         $extension = @end(explode(".", $_FILES['maps']['name']['pdfimage']));
         if (!empty($_FILES['maps']['name']['logo'])) {
            $extension = @end(explode(".", $_FILES['maps']['name']['logo']));

            if (!in_array($extension, $allowed_ext)) {
               $error[] = "Only " . @implode(",", $allowed_ext) . " allowed !";
            }
         }
         if (!empty($_FILES['maps']['name']['pdfimage'])) {
            $pdfextension = @end(explode(".", $_FILES['maps']['name']['pdfimage']));
            if (!in_array($pdfextension, $allowedpdf_ext)) {
               $error[] = "Only " . @implode(",", $allowedpdf_ext) . " allowed !";
            }
         }
         if (empty($error)) {
            $map->setCreatedOn(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $map->setLogo('');
            $em->persist($map);
            $em->flush();
            //mapsimages
            if (!empty($_FILES['maps'])) {
               $tmpeventshowcaseimage = "";
               $logoimage = "";
               $eventshowcaseimage = "";
               if (isset($_FILES['maps']['name']['logo']) && !empty($_FILES['maps']['name']['logo'])) {
                  $extension = @end(explode(".", $_FILES['maps']['name']['logo']));
                  if (in_array($extension, $allowed_ext)) {
                     $mapsimages = md5(uniqid()) . "_" . $map->getId() . "." . $extension;
                     move_uploaded_file($_FILES['maps']['tmp_name']['logo'], $map_image_dir . '/' . $mapsimages);
                     $qb = $em->createQueryBuilder();
                     $q = $qb->update('DroidInfotech\DroidBundle\Entity\Maps', 'u')
                             ->set('u.logo', '?2')
                             ->where('u.id = ?1')
                             ->setParameter(2, 'web/uploads/mapsimages/' . $mapsimages)
                             ->setParameter(1, $map->getId())
                             ->getQuery();
                     $p = $q->execute();
                     $em->flush();
                  }
               }
               if (isset($_FILES['maps']['name']['pdfimage']) && !empty($_FILES['maps']['name']['pdfimage'])) {
                  $extension = @end(explode(".", $_FILES['maps']['name']['pdfimage']));
                  if (in_array($extension, $allowedpdf_ext)) {
                     $mapsimages = md5(uniqid()) . "_" . $map->getId() . "." . $extension;
                     move_uploaded_file($_FILES['maps']['tmp_name']['pdfimage'], $map_image_dir . '/' . $mapsimages);
                     $qb = $em->createQueryBuilder();
                     $q = $qb->update('DroidInfotech\DroidBundle\Entity\Maps', 'u')
                             ->set('u.pdfimage', '?2')
                             ->where('u.id = ?1')
                             ->setParameter(2, 'web/uploads/mapsimages/' . $mapsimages)
                             ->setParameter(1, $map->getId())
                             ->getQuery();
                     $p = $q->execute();
                     $em->flush();
                  }
               }
            }

            return $this->redirectToRoute('maps_index');
         }
      }
      if (!empty($error)) {
         $this->addFlash(
                 'notice', implode(",", $error)
         );
         return $this->redirectToRoute('maps_new');
      }
      return $this->render('maps/new.html.twig', array(
                  'map' => $map,
                  'form' => $form->createView(),
      ));
   }

   /**
    * Displays a form to edit an existing Maps entity.
    *
    * @Route("/{id}/edit", name="maps_edit")
    * @Method({"GET", "POST"})
    */
   public function editAction(Request $request, Maps $map) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $deleteForm = $this->createDeleteForm($map);
      $editForm = $this->createForm('DroidInfotech\DroidBundle\Form\MapsType', $map);
      $editForm->add('eventId', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array('placeholder' => '--Select--',
                  'class' => 'DroidInfotechDroidBundle:Events',
                  'choice_label' => 'title',
                  'multiple' => false,
                  // 'expanded' => true,
                  'label' => 'Event'
              ))
              ->add('title')
              ->add('logo', \Symfony\Component\Form\Extension\Core\Type\FileType::class, array('mapped' => false, 'required' => false, 'label' => 'Upload PDF Logo'))
              ->add('pdfimage', \Symfony\Component\Form\Extension\Core\Type\FileType::class, array('mapped' => false, 'required' => false, 'label' => 'Upload PDF'));

      $editForm->handleRequest($request);
      $allowedpdf_ext = array('pdf', 'PDF');
      $allowed_ext = $this->getParameter('allowedExt');
      $map_image_dir = $this->getParameter('map_image_dir');
      $error = array();
      if ($editForm->isSubmitted() && $editForm->isValid()) {
         if (!empty($_FILES['maps']['name']['logo'])) {
            $extension = @end(explode(".", $_FILES['maps']['name']['logo']));

            if (!in_array($extension, $allowed_ext)) {
               $error[] = "Only " . @implode(",", $allowed_ext) . " allowed !";
            }
         }
         if (!empty($_FILES['maps']['name']['pdfimage'])) {
            $pdfextension = @end(explode(".", $_FILES['maps']['name']['pdfimage']));
            if (!in_array($pdfextension, $allowedpdf_ext)) {
               $error[] = "Only " . @implode(",", $allowedpdf_ext) . " allowed !";
            }
         }
         if (empty($error)) {
            $map->setCreatedOn(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($map);
            $em->flush();
            if (!empty($_FILES['maps'])) {
               $tmpeventshowcaseimage = "";
               $logoimage = "";
               $eventshowcaseimage = "";
               if (isset($_FILES['maps']['name']['logo']) && !empty($_FILES['maps']['name']['logo'])) {
                  $extension = @end(explode(".", $_FILES['maps']['name']['logo']));
                  if (in_array($extension, $allowed_ext)) {
                     $mapsimages = md5(uniqid()) . "_" . $map->getId() . "." . $extension;
                     move_uploaded_file($_FILES['maps']['tmp_name']['logo'], $map_image_dir . '/' . $mapsimages);
                     $qb = $em->createQueryBuilder();
                     $q = $qb->update('DroidInfotech\DroidBundle\Entity\Maps', 'u')
                             ->set('u.logo', '?2')
                             ->where('u.id = ?1')
                             ->setParameter(2, 'web/uploads/mapsimages/' . $mapsimages)
                             ->setParameter(1, $map->getId())
                             ->getQuery();
                     $p = $q->execute();
                     $em->flush();
                  }
               }
               if (isset($_FILES['maps']['name']['pdfimage']) && !empty($_FILES['maps']['name']['pdfimage'])) {
                  $extension = @end(explode(".", $_FILES['maps']['name']['pdfimage']));
                  if (in_array($extension, $allowedpdf_ext)) {
                     $mapsimages = md5(uniqid()) . "_" . $map->getId() . "." . $extension;
                     move_uploaded_file($_FILES['maps']['tmp_name']['pdfimage'], $map_image_dir . '/' . $mapsimages);
                     $qb = $em->createQueryBuilder();
                     $q = $qb->update('DroidInfotech\DroidBundle\Entity\Maps', 'u')
                             ->set('u.pdfimage', '?2')
                             ->where('u.id = ?1')
                             ->setParameter(2, 'web/uploads/mapsimages/' . $mapsimages)
                             ->setParameter(1, $map->getId())
                             ->getQuery();
                     $p = $q->execute();
                     $em->flush();
                  }
               }
            }

            return $this->redirectToRoute('maps_index');
         }
         if (!empty($error)) {
            $this->addFlash(
                    'notice', implode("\n", $error)
            );
            return $this->redirectToRoute('maps_edit', array('id' => $map->getId()));
         }
      }

      return $this->render('maps/edit.html.twig', array(
                  'map' => $map,
                  'edit_form' => $editForm->createView(),
                  'delete_form' => $deleteForm->createView(),
      ));
   }

   /**
    * Deletes a Maps entity.
    *
    * @Route("/{id}", name="maps_delete")
    * @Method("GET")
    */
   public function deleteAction(Request $request, Maps $map) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $map_image_dir = $this->getParameter('map_image_dir');
      $em = $this->getDoctrine()->getManager();
      $result = $em->getRepository('DroidInfotechDroidBundle:Maps')->findById($map->getId());
      foreach ($result as $result) {
         if (file_exists($map_image_dir . str_replace("web/uploads/mapsimages", "", $result->getPdfimage()))) {
            @unlink($map_image_dir . str_replace("web/uploads/mapsimages", "", $result->getPdfimage()));
         }
         if (file_exists($map_image_dir . str_replace("web/uploads/mapsimages", "", $result->getLogo()))) {
            @unlink($map_image_dir . str_replace("web/uploads/mapsimages", "", $result->getLogo()));
         }
      }
      $em->remove($map);
      $em->flush();

      return $this->redirectToRoute('maps_index');
   }

   /**
    * Creates a form to delete a Maps entity.
    *
    * @param Maps $map The Maps entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
   private function createDeleteForm(Maps $map) {
      return $this->createFormBuilder()
                      ->setAction($this->generateUrl('maps_delete', array('id' => $map->getId())))
                      ->setMethod('DELETE')
                      ->getForm()
      ;
   }

   /* Maps List Webservice */

   public function mapListAction(Request $request) {
      $token = $request->request->get("token");
      $eventId = $request->request->get("eventId");
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
      } else if (trim($eventId) == "") {
         $status_code = 0;
         $message = "EventId is missing";
         $data = array();
      } else {

         $em = $this->getDoctrine()->getManager();
         $dql = "SELECT ev.id,ev.title,ev.pdfimage,ev.logo
                  FROM DroidInfotechDroidBundle:Maps ev
                    WHERE ev.active=1 and ev.eventId='" . $eventId . "' and ev.pdfimage!='' order by ev.title asc
                  ";

         $result = $em->createQuery($dql)->getResult();
         if ($result) {
            $status_code = 1;
            $message = "Maps List";
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
