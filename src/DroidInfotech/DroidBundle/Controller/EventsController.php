<?php

namespace DroidInfotech\DroidBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DroidInfotech\DroidBundle\Entity\Events;
use DroidInfotech\DroidBundle\Form\EventsType;
use DroidInfotech\DroidBundle\Entity\EventImages;
use DroidInfotech\DroidBundle\Entity\EventSchedule;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Events controller.
 *
 * @Route("/events")
 */
class EventsController extends Controller {

   /**
    * Lists all Events entities.
    *
    * @Route("/", name="events_index")
    * @Method("GET")
    */
   public function indexAction(Request $request) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $events = new Events();
      $em = $this->getDoctrine()->getManager();
      $dql = "SELECT a FROM DroidInfotechDroidBundle:Events a  ";
      $form = $this->createForm('DroidInfotech\DroidBundle\Form\EventsType', $events);
      $form->handleRequest($request);
      if ($request->isMethod('POST')) {

         $dqls = array();
         if ($events->getTitle()) {
            $dqls[] = " a.title like '" . $events->getTitle() . "%'";
         }
         if ($events->getLocation()) {
            $dqls[] = " a.location like '" . $events->getLocation() . "%'";
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

      return $this->render('events/index.html.twig', array(
                  'pagination' => $pagination,
                  'form' => $form->createView()
      ));
   }

   /**
    * Creates a new Events entity.
    *
    * @Route("/new", name="events_new")
    * @Method({"GET", "POST"})
    */
   public function newAction(Request $request) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $em = $this->getDoctrine()->getManager();
      $eventlist = $em->getRepository('DroidInfotechDroidBundle:Events')->findAll();
      $l = 0;
      if ($eventlist) {

         foreach ($eventlist as $eventlists) {
            $l++;
         }
      }

      if ($l >= 2) {
         $this->addFlash(
                 'notice', 'Only two events can be added'
         );
         return $this->redirectToRoute('events_index');
      }


      /* print '<pre>';print_r($_REQUEST);
        print_r($_FILES);
        die */;
      $allowed_ext = $this->getParameter('allowedExt');

      $event = new Events();

      $form = $this->createForm('DroidInfotech\DroidBundle\Form\EventsType', $event);
      $form->handleRequest($request);

      $error = array();
      $event_image_dir = $this->getParameter('event_image_dir');
      $flg = false;
      if ($request->isMethod('POST')) {

         //  print '<pre>';print_r($_REQUEST);
         //  echo strtotime($_REQUEST['events']['event_schedule']) > strtotime($_REQUEST['events']['event_endschedule']);


         if (trim($_REQUEST['events']['event_schedule']) == "" || !isset($_REQUEST['event_schedules']) || empty($_REQUEST['event_schedules'])) {
            $error[] = "Please enter atleast two event schedule date";
         } else if (strtotime($_REQUEST['events']['event_schedule']) > strtotime($_REQUEST['events']['event_endschedule'])) {
            $error[] = "EndTime: " . $_REQUEST['events']['event_endschedule'] . " should be greater than StartTime: " . $_REQUEST['events']['event_schedule'];
         } else if (strtotime($_REQUEST['events']['event_endschedule']) < strtotime(date("Y-m-d H:i"))) {
            $error[] = "EndTime: " . $_REQUEST['events']['event_endschedule'] . " should be greater than equal to the Current date ";
         } else if (empty($_REQUEST['events']['exhibitorIds'])) {
            $error[] = "Please select exhibitors";
         }
         if (!empty($_FILES['events']['name']['logo'])) {
            $extension = @end(explode(".", $_FILES['events']['name']['logo']));

            if (!in_array($extension, $allowed_ext)) {
               $flg = true;
            }
         }
         if (isset($_FILES['events']['name']['event_Image']) && !empty($_FILES['events']['name']['event_Image'])) {
            $pdfextension = @end(explode(".", $_FILES['events']['name']['event_Image']));
            if (!in_array($pdfextension, $allowed_ext)) {
               $flg = true;
            }
         }
         if (isset($_FILES['event_Image']) && !empty($_FILES['event_Image'])) {
            $tmpname2 = $_FILES['event_Image']['tmp_name'];

            foreach ($tmpname2 as $key => $tmpnames2) {
               $extension = @end(explode(".", $_FILES['event_Image']['name'][$key]));
               if (!in_array($extension, $allowed_ext)) {
                  $flg = true;
               }
            }
         }
         if ($flg) {
            $error[] = "Only " . @implode(",", $allowed_ext) . " allowed !";
         }
         if (empty($error)) {
            $eventexits = $em->getRepository('DroidInfotechDroidBundle:Events')->findByTitle($_REQUEST['events']['title']);
            if ($eventexits) {
               $error[] = "Record alread exists";
            } else {

               /** Geocode location* */
               $objUtilityService = $this->get('Utility');
               $geoCodedAddress = $objUtilityService->geocodeLocation($event->getAddress());
               $event->setLatitude(null);
               $event->setLongitude(null);
               if (!empty($geoCodedAddress)) {
                  $event->setLatitude($geoCodedAddress['lat']);
                  $event->setLongitude($geoCodedAddress['lng']);
               }


               $event->setCreatedOn(new \DateTime("now"));
               $em->persist($event);
               $em->flush();
               $newevent = $em->getRepository('DroidInfotechDroidBundle:Events')->find(array('id' => $event->getId()));
               /*                * *******Event Schedule********* */
               if (isset($_REQUEST['events']['event_schedule']) && !empty($_REQUEST['events']['event_schedule'])) {
                  $dql1 = "DELETE FROM event_schedule WHERE event_id_id='" . $event->getId() . "'";
                  $results = $em->getConnection()->prepare($dql1);
                  $results->execute();
                  $EventSchedule = new EventSchedule;
                  $schedule_date = new \DateTime(trim($_REQUEST['events']['event_schedule']));
                  $schedule_enddate = new \DateTime(trim($_REQUEST['events']['event_endschedule']));
                  if (strtotime($_REQUEST['events']['event_schedule']) < strtotime($_REQUEST['events']['event_endschedule'])) {
                     $EventSchedule->setScheduleDayTime($schedule_date);
                     $EventSchedule->setScheduleEndTime($schedule_enddate);
                     $EventSchedule->setEventId($newevent);
                     $EventSchedule->setCreatedOn(new \DateTime("now"));
                     $em->persist($EventSchedule);
                     $em->flush();
                  } else {
                     $error[] = "EndTime: " . $_REQUEST['events']['event_endschedule'] . " should be greater than StartTime: " . $_REQUEST['events']['event_schedule'];
                  }
               }
               if (isset($_REQUEST['event_schedules']) && !empty($_REQUEST['event_schedules'])) {
                  $event_scheduless = $_REQUEST['event_schedules'];
                  $event_endschedules = $_REQUEST['event_endschedules'];
                  if (!empty($event_scheduless)) {
                     foreach ($event_scheduless as $key => $event_scheduless) {
                        if ($event_scheduless != '') {
                           $EventSchedule = new EventSchedule;
                           $schedule_date = new \DateTime(trim($event_scheduless));
                           $schedule_enddate = new \DateTime(trim($event_endschedules[$key]));
                           if (strtotime($event_scheduless) < strtotime($event_endschedules[$key])) {
                              $EventSchedule->setScheduleDayTime($schedule_date);
                              $EventSchedule->setScheduleEndTime($schedule_enddate);
                              $EventSchedule->setEventId($newevent);
                              $EventSchedule->setCreatedOn(new \DateTime("now"));
                              $em->persist($EventSchedule);
                              $em->flush();
                           } else {
                              $error[] = "EndTime: " . $event_scheduless . " should be greater than StartTime: " . $event_endschedules[$key];
                           }
                        }
                     }
                  }
               }
               /*                * ********End here Event Schedule********* */
               /*                * ********logo image************ */
               if (isset($_FILES['events']['name']['logo']) && !empty($_FILES['events']['name']['logo'])) {
                  $tmplogo = $_FILES['events']['tmp_name']['logo'];
                  $extension = @end(explode(".", $_FILES['events']['name']['logo']));
                  if (in_array($extension, $allowed_ext)) {
                     $logofileName = md5(uniqid()) . "_" . $event->getId() . "." . $extension;
                     move_uploaded_file($tmplogo, $event_image_dir . '/' . $logofileName);
                     $qb = $em->createQueryBuilder();
                     $q = $qb->update('DroidInfotech\DroidBundle\Entity\Events', 'u')
                             ->set('u.logo', '?2')
                             ->where('u.id = ?3')
                             ->setParameter(2, 'web/uploads/eventimages/' . $logofileName)
                             ->setParameter(3, $event->getId())
                             ->getQuery();
                     $p = $q->execute();
                     $em->flush();
                  }
               }
               /*                * ********end logo image************ */
               /*                * ********Event Image********* */


               if (isset($_FILES['events']['name']['event_Image']) && !empty($_FILES['events']['name']['event_Image'])) {
                  $tmpnames = $_FILES['events']['tmp_name']['event_Image'];
                  $queryBuilder = $em
                          ->createQueryBuilder()
                          ->delete('DroidInfotechDroidBundle:EventImages', 'a')
                          ->where('a.eventId = :parent')
                          ->setParameter('parent', $event->getId());
                  $queryBuilder->getQuery()->execute();

                  $extension = @end(explode(".", $_FILES['events']['name']['event_Image']));
                  if (in_array($extension, $allowed_ext)) {
                     $fileName = md5(uniqid()) . "_" . $event->getId() . "." . $extension;
                     move_uploaded_file($tmpnames, $event_image_dir . '/' . $fileName);
                     $EventImages = new EventImages;
                     $EventImages->setPhoto('web/uploads/eventimages/' . $fileName);
                     $EventImages->setEventId($newevent);
                     $EventImages->setCreatedOn(new \DateTime("now"));
                     $em->persist($EventImages);
                     $em->flush();
                  }
               }
               if (isset($_FILES['event_Image']) && !empty($_FILES['event_Image'])) {
                  $tmpname2 = $_FILES['event_Image']['tmp_name'];
                  foreach ($tmpname2 as $key => $tmpnames2) {
                     $extension = @end(explode(".", $_FILES['event_Image']['name'][$key]));
                     if (in_array($extension, $allowed_ext)) {
                        $fileName = md5(uniqid()) . "_" . $event->getId() . "." . $extension;
                        move_uploaded_file($tmpnames2, $event_image_dir . '/' . $fileName);
                        $EventImages = new EventImages;
                        $EventImages->setPhoto('web/uploads/eventimages/' . $fileName);
                        $EventImages->setEventId($newevent);
                        $EventImages->setCreatedOn(new \DateTime("now"));
                        $em->persist($EventImages);
                        $em->flush();
                     }
                  }
               }
               /*                * ********End here Event Image********* */
               if (!empty($_REQUEST['events']['exhibitorIds'])) {
                  $exhibitorIds = $_REQUEST['events']['exhibitorIds'];
                  $dql1 = "DELETE FROM events_exhibitor WHERE events_id='" . $event->getId() . "'";
                  $results = $em->getConnection()->prepare($dql1);
                  $results->execute();
                  //events_exhibitor
                  foreach ($exhibitorIds as $exhibitorId) {
                     //events_exhibitor
                     $dql = "INSERT INTO events_exhibitor
                  set exhibitor_id='" . $exhibitorId . "',events_id='" . $event->getId() . "'";

                     $results = $em->getConnection()->prepare($dql);
                     $results->execute();
                  }
               }
               if (!empty($error)) {
                  $this->addFlash(
                          'notice', implode("<br />", $error)
                  );
                  // return $this->redirectToRoute('events_new');
               } else {
                  $this->addFlash(
                          'notice', 'Record has been inserted successfully !'
                  );
                  return $this->redirectToRoute('events_index');
               }
            }
         }
      }

      return $this->render('events/new.html.twig', array(
                  'event' => $event,
                  'form' => $form->createView(),
                  'error' => implode("<br />", $error)
      ));
   }

   /**
    * Displays a form to edit an existing Events entity.
    *
    * @Route("/{id}/edit", name="events_edit")
    * @Method({"GET", "POST"})
    */
   public function editAction(Request $request, Events $event) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $error = array();

      $allowed_ext = $this->getParameter('allowedExt');
      $deleteForm = $this->createDeleteForm($event);

      $editForm = $this->createForm('DroidInfotech\DroidBundle\Form\EventsType', $event);

      $editForm->handleRequest($request);
      $em = $this->getDoctrine()->getManager();
      $event_image_dir = $this->getParameter('event_image_dir');
      if ($request->isMethod('POST')) {
         $flg = false;
         //  print '<pre>';print_r($_FILES);print_r($_REQUEST);die;
         if (trim($_REQUEST['events']['event_schedule']) == "" || !isset($_REQUEST['event_schedules']) || empty($_REQUEST['event_schedules'])) {
            $error[] = "Please enter atleast two event schedule date";
         } else if (strtotime($_REQUEST['events']['event_schedule']) > strtotime($_REQUEST['events']['event_endschedule'])) {
            $error[] = "EndTime: " . $_REQUEST['events']['event_endschedule'] . " should be greater than StartTime: " . $_REQUEST['events']['event_schedule'];
         } else if (strtotime($_REQUEST['events']['event_endschedule']) < strtotime(date("Y-m-d H:i"))) {
            $error[] = "EndTime: " . $_REQUEST['events']['event_endschedule'] . " should be greater than equal to the Current date ";
         } else if (empty($_REQUEST['events']['exhibitorIds'])) {
            $error[] = "Please select exhibitors";
         }
         if (!empty($_FILES['events']['name']['logo'])) {
            $extension = @end(explode(".", $_FILES['events']['name']['logo']));

            if (!in_array($extension, $allowed_ext)) {
               $flg = true;
            }
         }
         if (isset($_FILES['events']['name']['event_Image']) && !empty($_FILES['events']['name']['event_Image'])) {
            $pdfextension = @end(explode(".", $_FILES['events']['name']['event_Image']));
            if (!in_array($pdfextension, $allowed_ext)) {
               $flg = true;
            }
         }
         if (isset($_FILES['event_Image']) && !empty($_FILES['event_Image'])) {
            $tmpname2 = $_FILES['event_Image']['tmp_name'];

            foreach ($tmpname2 as $key => $tmpnames2) {
               $extension = @end(explode(".", $_FILES['event_Image']['name'][$key]));
               if (!in_array($extension, $allowed_ext)) {
                  $flg = true;
               }
            }
         }
         if ($flg) {
            $error[] = "Only " . @implode(",", $allowed_ext) . " allowed !";
         }
         if (empty($error)) {
            $eventexits = $em->getRepository('DroidInfotechDroidBundle:Events')->findByTitle($_REQUEST['events']['title']);
            //echo $eventexits->getTitle();die;
            //if ($eventexits[0]->getId() != $event->getId()) {
            //  $error = "Record alread exists";
            //} else {


            /** Geocode location* */
            $objUtilityService = $this->get('Utility');
            $geoCodedAddress = $objUtilityService->geocodeLocation($event->getAddress());
            $event->setLatitude(null);
            $event->setLongitude(null);
            if (!empty($geoCodedAddress)) {
               $event->setLatitude($geoCodedAddress['lat']);
               $event->setLongitude($geoCodedAddress['lng']);
            }


            $em->persist($event);
            $em->flush();
            $newevent = $em->getRepository('DroidInfotechDroidBundle:Events')->find(array('id' => $event->getId()));

            /*             * ********logo image************ */
            if (isset($_FILES['events']['name']['logo'])) {
               $tmplogo = $_FILES['events']['tmp_name']['logo'];
               $extension = @end(explode(".", $_FILES['events']['name']['logo']));
               if (in_array($extension, $allowed_ext)) {
                  $logofileName = md5(uniqid()) . "_" . $event->getId() . "." . $extension;
                  move_uploaded_file($tmplogo, $event_image_dir . '/' . $logofileName);
                  $qb = $em->createQueryBuilder();
                  $q = $qb->update('DroidInfotech\DroidBundle\Entity\Events', 'u')
                          ->set('u.logo', '?2')
                          ->where('u.id = ?3')
                          ->setParameter(2, 'web/uploads/eventimages/' . $logofileName)
                          ->setParameter(3, $event->getId())
                          ->getQuery();
                  $p = $q->execute();
                  $em->flush();
               }
            }
            /*             * ********end logo image************ */
            /*             * ******Event Image********* */



            if (isset($_FILES['events']['name']['event_Image']) && !empty($_FILES['events']['name']['event_Image'])) {
               $tmpnames = $_FILES['events']['tmp_name']['event_Image'];
               $dql1 = "DELETE FROM event_images WHERE event_id_id='" . $event->getId() . "'";
               $results = $em->getConnection()->prepare($dql1);
               $results->execute();

               $extension = @end(explode(".", $_FILES['events']['name']['event_Image']));
               if (in_array($extension, $allowed_ext)) {
                  $fileName = md5(uniqid()) . "_" . $event->getId() . "." . $extension;
                  move_uploaded_file($tmpnames, $event_image_dir . '/' . $fileName);
                  $EventImages = new EventImages;
                  $EventImages->setPhoto('web/uploads/eventimages/' . $fileName);
                  $EventImages->setEventId($newevent);
                  $EventImages->setCreatedOn(new \DateTime("now"));
                  $em->persist($EventImages);
                  $em->flush();
               }
            }
            if (isset($_FILES['event_Image']) && !empty($_FILES['event_Image'])) {
               $tmpname2 = $_FILES['event_Image']['tmp_name'];
               foreach ($tmpname2 as $key => $tmpnames2) {
                  $extension = @end(explode(".", $_FILES['event_Image']['name'][$key]));
                  if (in_array($extension, $allowed_ext)) {
                     $fileName = md5(uniqid()) . "_" . $event->getId() . "." . $extension;
                     move_uploaded_file($tmpnames2, $event_image_dir . '/' . $fileName);
                     $EventImages = new EventImages;
                     $EventImages->setPhoto('web/uploads/eventimages/' . $fileName);
                     $EventImages->setEventId($newevent);
                     $EventImages->setCreatedOn(new \DateTime("now"));
                     $em->persist($EventImages);
                     $em->flush();
                  }
               }
            }

            /*             * *******End here Event Image********* */
            /*             * *******Event Schedule********* */
            // print '<pre>';print_r($_REQUEST);die;
            if (isset($_REQUEST['events']['event_schedule']) && !empty($_REQUEST['events']['event_schedule'])) {
               $dql1 = "DELETE FROM event_schedule WHERE event_id_id='" . $event->getId() . "'";
               $results = $em->getConnection()->prepare($dql1);
               $results->execute();
               $EventSchedule = new EventSchedule;
               $schedule_date = new \DateTime(trim($_REQUEST['events']['event_schedule']));
               $schedule_enddate = new \DateTime(trim($_REQUEST['events']['event_endschedule']));
               if (strtotime($_REQUEST['events']['event_schedule']) < strtotime($_REQUEST['events']['event_endschedule'])) {
                  $EventSchedule->setScheduleDayTime($schedule_date);
                  $EventSchedule->setScheduleEndTime($schedule_enddate);
                  $EventSchedule->setEventId($newevent);
                  $EventSchedule->setCreatedOn(new \DateTime("now"));
                  $em->persist($EventSchedule);
                  $em->flush();
               } else {
                  $error .= "EndTime: " . $_REQUEST['events']['event_endschedule'] . " should be greater than StartTime: " . $_REQUEST['events']['event_schedule'];
               }
            }
            if (isset($_REQUEST['event_schedules']) && !empty($_REQUEST['event_schedules'])) {
               $event_scheduless = $_REQUEST['event_schedules'];
               $event_endschedules = $_REQUEST['event_endschedules'];
               if (!empty($event_scheduless)) {
                  foreach ($event_scheduless as $key => $event_scheduless) {
                     if ($event_scheduless != '') {
                        $EventSchedule = new EventSchedule;
                        $schedule_date = new \DateTime(trim($event_scheduless));
                        $schedule_enddate = new \DateTime(trim($event_endschedules[$key]));
                        if (strtotime($event_scheduless) < strtotime($event_endschedules[$key])) {
                           $EventSchedule->setScheduleDayTime($schedule_date);
                           $EventSchedule->setScheduleEndTime($schedule_enddate);
                           $EventSchedule->setEventId($newevent);
                           $EventSchedule->setCreatedOn(new \DateTime("now"));
                           $em->persist($EventSchedule);
                           $em->flush();
                        } else {
                           $error = "EndTime: " . $event_scheduless . " should be greater than StartTime: " . $event_endschedules[$key];
                        }
                     }
                  }
               }
            }
            if (!empty($_REQUEST['events']['exhibitorIds'])) {
               $exhibitorIds = $_REQUEST['events']['exhibitorIds'];
               $dql1 = "DELETE FROM events_exhibitor WHERE events_id='" . $event->getId() . "'";
               $results = $em->getConnection()->prepare($dql1);
               $results->execute();
               //events_exhibitor
               foreach ($exhibitorIds as $exhibitorId) {
                  //events_exhibitor
                  $dql = "INSERT INTO events_exhibitor
                  set exhibitor_id='" . $exhibitorId . "',events_id='" . $event->getId() . "'";

                  $results = $em->getConnection()->prepare($dql);
                  $results->execute();
               }
            }
            if (!empty($error)) {
               $this->addFlash(
                       'notice', implode(",", $error)
               );
            } else {
               $this->addFlash(
                       'notice', 'Record has been updated successfully !'
               );
               return $this->redirectToRoute('events_index');
            }
            //
         }
         /*          * ********End here Event Image********* */
         // 
         // }
      }
      $eventSch = $em->getRepository('DroidInfotechDroidBundle:EventSchedule')->findByEventId($event->getId());
      $eventImage = $em->getRepository('DroidInfotechDroidBundle:EventImages')->findByEventId($event->getId());
      return $this->render('events/edit.html.twig', array(
                  'event' => $event,
                  'form' => $editForm->createView(),
                  'delete_form' => $deleteForm->createView(),
                  'error' => implode(",", $error),
                  'eventSch' => $eventSch,
                  'eventImage' => $eventImage
      ));
   }

   /**
    * Deletes a Events entity.
    *
    * @Route("/delete/{id}", name="events_delete")
    * @Method("GET")
    */
   public function deleteAction(Request $request, Events $event) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }

      $em = $this->getDoctrine()->getManager();
      $result = $em->getRepository('DroidInfotechDroidBundle:EventImages')->findByEventId($event->getId());
      foreach ($result as $result) {
         if (file_exists($this->getParameter('event_image_dir') . str_replace("web/uploads/eventimages", "", $result->getPhoto()))) {
            unlink($this->getParameter('event_image_dir') . str_replace("web/uploads/eventimages", "", $result->getPhoto()));
         }
      }
      $queryBuilder = $em
              ->createQueryBuilder()
              ->delete('DroidInfotechDroidBundle:EventImages', 'a')
              ->where('a.eventId = :parent')
              ->setParameter('parent', $event->getId());
      $queryBuilder->getQuery()->execute();
      $queryBuilder = $em
              ->createQueryBuilder()
              ->delete('DroidInfotechDroidBundle:EventSchedule', 'a')
              ->where('a.eventId = :parent')
              ->setParameter('parent', $event->getId());
      $queryBuilder->getQuery()->execute();
      $queryBuilder = $em
              ->createQueryBuilder()
              ->delete('DroidInfotechDroidBundle:Survey', 'a')
              ->where('a.eventId = :parent')
              ->setParameter('parent', $event->getId());
      $queryBuilder->getQuery()->execute();
      $queryBuilder = $em
              ->createQueryBuilder()
              ->delete('DroidInfotechDroidBundle:Events', 'a')
              ->where('a.id = :parent')
              ->setParameter('parent', $event->getId());
      $queryBuilder->getQuery()->execute();
      //$em->remove($event);
      // $em->flush();
      /* $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();
        } */
      $this->addFlash(
              'notice', 'Record has been deleted successfully !'
      );
      return $this->redirectToRoute('events_index');
   }

   /**
    * Deletes logo Events entity.
    *
    * @Route("/events/logo_delete/{id}", name="eventslogo_delete")
    * @Method("GET")
    */
   public function eventlogoRemoveAction(Request $request, Events $event) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $em = $this->getDoctrine()->getManager();
      $result = $em->getRepository('DroidInfotechDroidBundle:Events')->findById($event->getId());
      foreach ($result as $result) {
         if (file_exists($this->getParameter('event_image_dir') . str_replace("web/uploads/eventimages", "", $result->getLogo()))) {
            unlink($this->getParameter('event_image_dir') . str_replace("web/uploads/eventimages", "", $result->getLogo()));
         }
      }
      if ($event) {
         $qb = $em->createQueryBuilder();
         $q = $qb->update('DroidInfotech\DroidBundle\Entity\Events', 'u')
                 ->set('u.logo', '?2')
                 ->where('u.id = ?3')
                 ->setParameter(2, '')
                 ->setParameter(3, $event->getId())
                 ->getQuery();
         $p = $q->execute();
         $em->flush();
      }
      $this->addFlash(
              'notice', 'Logo has been removed successfully !'
      );
      return $this->redirectToRoute('events_edit', array('id' => $event->getId()));
   }

   /**
    * Deletes images Events entity.
    *
    * @Route("/events/images_delete/{EventImages}/{id}", name="eventsimage_delete")
    * @Method("GET")
    */
   public function eventimagesRemoveAction(Request $request, EventImages $EventImages, Events $event) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $em = $this->getDoctrine()->getManager();
      $result = $em->getRepository('DroidInfotechDroidBundle:EventImages')->findBy(array('id' => $EventImages->getId()));
      foreach ($result as $result) {
         if (file_exists($this->getParameter('event_image_dir') . str_replace("web/uploads/eventimages", "", $result->getPhoto()))) {
            unlink($this->getParameter('event_image_dir') . str_replace("web/uploads/eventimages", "", $result->getPhoto()));
         }
      }
      $queryBuilder = $em
              ->createQueryBuilder()
              ->delete('DroidInfotechDroidBundle:EventImages', 'a')
              ->where('a.id = :parent')
              ->setParameter('parent', $EventImages->getId());
      $queryBuilder->getQuery()->execute();
      $this->addFlash(
              'notice', 'Image has been removed successfully !'
      );

      return $this->redirectToRoute('events_edit', array('id' => $event->getId()));
   }

   /**
    * Creates a form to delete a Events entity.
    *
    * @param Events $event The Events entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
   private function createDeleteForm(Events $event) {

      return $this->createFormBuilder()
                      ->setAction($this->generateUrl('events_delete', array('id' => $event->getId())))
                      ->setMethod('DELETE')
                      ->getForm()
      ;
   }
   
   
   protected function getContentAsArray(Request $request){
    $content = $request->getContent();
    if(empty($content)){
        throw new BadRequestHttpException("Content is empty");
    }

    

    return new ArrayCollection(json_decode($content, true));
}

   public function eventListAction(Request $request) {
       $content=$this->getContentAsArray($request);
       $request->request=$content;
      $token = $request->request->get("token");
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
         $eventId = $request->request->get("eventId");
         $dql = "SELECT ev.id as eventId,
                     ev.createdOn,ev.title,ev.description,ev.logo,ev.location,ev.address,ev.logo,ev.faqslink as faq,ev.schedulelink as schedule,ev.website as EventInfo,
                     ev.longitude as Longitudes,ev.latitude as Latitudes
                  FROM DroidInfotechDroidBundle:Events ev
                  WHERE ev.active=1 and ev.id='" . $eventId . "' order by ev.createdOn desc";
         $result = $em->createQuery($dql)->setMaxResults(2)->getResult();
         if ($result) {
            $status_code = 1;
            $message = "Event List";
            $data_arr = [];

            foreach ($result as $datas) {
               $data['Events'] = $datas;
               $imagedata = $em->getRepository('DroidInfotechDroidBundle:EventImages')->findByEventId($datas['eventId']);
               $data['Events']['eventImages'] = array();
               $data['Events']['eventScheduleDate'] = array();
               foreach ($imagedata as $imagedatas) {
                  $data['Events']['eventImages'][] = $imagedatas->getPhoto();
               }
               $scheduledata = $em->getRepository('DroidInfotechDroidBundle:EventSchedule')->findByEventId($datas['eventId']);
               foreach ($scheduledata as $scheduledatas) {
                  $data['Events']['eventScheduleDate'][] = $scheduledatas->getScheduleDayTime()->format("l,F d,Y") . " " . $scheduledatas->getScheduleDayTime()->format("h:i A") . " TO " . $scheduledatas->getScheduleEndTime()->format("h:i A");
               }
            }
         }
      }

      $json = json_encode(array(
          'message' => $message,
          'data' => $data,
          'status_code' => $status_code
              ), JSON_UNESCAPED_SLASHES);
      return new Response($json, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'application/json'));
   }

   public function eventLocationAction(Request $request) {
      $token = $request->request->get("token");
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
         $dql = "SELECT  ev.id as eventId,ev.location,ev.logo,ev.address,ev.faqslink as faq,ev.schedulelink as schedule,ev.website as EventInfo,
                    ev.longitude as Longitudes,ev.latitude as Latitudes
                    FROM DroidInfotechDroidBundle:Events ev
                    WHERE ev.active=1 order by ev.createdOn desc";

         $result = $em->createQuery($dql)->setMaxResults(2)->getResult();
         if ($result) {
            $status_code = 1;
            $message = "Event Location";
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
