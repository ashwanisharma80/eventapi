<?php

namespace DroidInfotech\DroidBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DroidInfotech\DroidBundle\Entity\Survey;
use DroidInfotech\DroidBundle\Form\SurveyType;
use DroidInfotech\DroidBundle\Entity\Question;
use DroidInfotech\DroidBundle\Entity\Answer;
use DroidInfotech\DroidBundle\Entity\User;
use DroidInfotech\DroidBundle\Entity\SavedSurvey;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Survey controller.
 *
 * @Route("/survey")
 */
class SurveyController extends Controller {

   /**
    * Lists all Survey entities.
    *
    * @Route("/", name="survey_index")
    * @Method("GET")
    */
   public function indexAction() {
      $em = $this->getDoctrine()->getManager();
      $dqlsurvey = "SELECT sy.id,sy.title,sy.descriptions,sy.active,sy.createdOn,ev.title as event_title FROM DroidInfotechDroidBundle:Survey sy JOIN DroidInfotechDroidBundle:Events ev WITH sy.eventId=ev.id";

      $surveys = $em->createQuery($dqlsurvey)->getResult();
      // print_r($surveys);     
      //$surveys = $em->getRepository('DroidInfotechDroidBundle:Survey')->findAll();
      return $this->render('survey/index.html.twig', array(
                  'surveys' => $surveys,
      ));
   }

   /**
    * Creates a new Survey entity.
    *
    * @Route("/new", name="survey_new")
    * @Method({"GET", "POST"})
    */
   public function newAction(Request $request) {
      $error = "";
      $survey = new Survey();
      $form = $this->createForm('DroidInfotech\DroidBundle\Form\SurveyType', $survey);
      $form->handleRequest($request);
      $em = $this->getDoctrine()->getManager();

      if ($request->isMethod('POST')) {
         // print '<pre>';
         //print_r($_REQUEST);die;
         $survey_title = $request->request->get("survey_title");
         $descriptions = $request->request->get("descriptions");
         $active = $request->request->get("active");
         $question = $request->request->get("question");
         $answer1 = $request->request->get("answer1");
         $answer2 = $request->request->get("answer2");
         $answer3 = $request->request->get("answer3");
         $answer4 = $request->request->get("answer4");
         $surveyelement = $request->request->get('survey');
         $eventId = $surveyelement['eventId'];
         $res = $em->getRepository('DroidInfotechDroidBundle:Survey')->findOneBy(array('eventId' => $eventId));

         if (!$res && trim($survey_title) <> "") {
            $survey->setCreatedOn(new \DateTime());
            $survey->setTitle($survey_title);
            $survey->setDescriptions($descriptions);
            $survey->setActive($active);
            $survey->setCreatedOn(new \DateTime("now"));
            $em->persist($survey);
            $em->flush();

            for ($i = 0; $i < count($question); $i++) {
               $em = $this->getDoctrine()->getManager();
               $questions = new Question();
               $res = $em->getRepository('DroidInfotechDroidBundle:Question')->findByText($question[$i]);
               if (!$res && $question[$i] <> "") {
                  $questions->setCreatedOn(new \DateTime());
                  $questions->setText($question[$i]);
                  $questions->setSurveys($survey);
                  $em->persist($questions);
                  $em->flush();
                  if (!empty($answer1) && trim($answer1[$i]) <> "") {
                     $answers = new Answer();
                     $answers->setCreatedOn(new \DateTime());
                     $answers->setText($answer1[$i]);
                     $answers->setQuestions($questions);
                     $em->persist($answers);
                     $em->flush();
                  }
                  if (!empty($answer2) && trim($answer2[$i]) <> "") {
                     $answers = new Answer();
                     $answers->setCreatedOn(new \DateTime());
                     $answers->setText($answer2[$i]);
                     $answers->setQuestions($questions);
                     $em->persist($answers);
                     $em->flush();
                  }
                  if (!empty($answer3) && trim($answer3[$i]) <> "") {
                     $answers = new Answer();
                     $answers->setCreatedOn(new \DateTime());
                     $answers->setText($answer3[$i]);
                     $answers->setQuestions($questions);
                     $em->persist($answers);
                     $em->flush();
                  }
                  if (!empty($answer4) && trim($answer4[$i]) <> "") {
                     $answers = new Answer();
                     $answers->setCreatedOn(new \DateTime());
                     $answers->setText($answer4[$i]);
                     $answers->setQuestions($questions);
                     $em->persist($answers);
                     $em->flush();
                  }
               }
            }
            return $this->redirectToRoute('survey_index');
         } else {
            $error = "A survey is already activated for this event";
         }
      }




      return $this->render('survey/new.html.twig', array(
                  'survey' => $survey,
                  'form' => $form->createView(),
                  'error' => $error
      ));
   }

   /**
    * Displays all App Users.
    *
    * @Route("/userapp", name="user_app")
    * @Method({"GET", "POST"})
    */
   public function userappAction(Request $request) {

      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $user = new User();
      $em = $this->getDoctrine()->getManager();
      $dql = "SELECT a FROM DroidInfotechDroidBundle:User a ";
      $dql.= "WHERE (a.roles like '%[\"ROLE_APPUSER%')";
      //echo $dql;die;
      $query = $em->createQuery($dql);
      $paginator = $this->get('knp_paginator');
      $pagination = $paginator->paginate(
              $query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
      );

      return $this->render('user/appusers.html.twig', array(
                  'pagination' => $pagination,
      ));
   }

   /**
    * Displays a form to edit an existing Survey entity.
    *
    * @Route("/{id}/edit", name="survey_edit")
    * @Method({"GET", "POST"})
    */
   public function editAction(Request $request, Survey $survey) {
      $deleteForm = $this->createDeleteForm($survey);
      $editForm = $this->createForm('DroidInfotech\DroidBundle\Form\SurveyType', $survey);
      $em = $this->getDoctrine()->getManager();
      $editForm->handleRequest($request);
      $error = "";
      if ($request->isMethod('POST')) {

         $survey_title = $request->request->get("survey_title");
         $descriptions = $request->request->get("descriptions");
         $active = $request->request->get("active");
         $surveyid = $request->request->get("survey_id");
         $surveyelement = $request->request->get('survey');
         $eventId = $surveyelement['eventId'];
         $res1 = $em->getRepository('DroidInfotechDroidBundle:Survey')->findBy(array('eventId' => $eventId));
         $flg = true;
         if ($res1) {
            foreach ($res1 as $ress) {
               if ($surveyid != $ress->getId()) {
                  $flg = false;
                  break;
               }
            }
         }


         /**
          * Delete all previous responses to this survey 
          * * */
         $savedSurveyRowset = $em->getRepository('DroidInfotechDroidBundle:SavedSurvey')->findBy(array('surveyId' => $surveyid));
         foreach ($savedSurveyRowset as $savedSurveyRow) {
            $em->remove($savedSurveyRow);
         }

         $em->flush();



         if (trim($survey_title) <> "" && $flg) {
            $survey->setActive($active);
            $survey->setTitle($survey_title);
            $survey->setDescriptions($descriptions);
            $survey->setCreatedOn(new \DateTime());
            $em->persist($survey);
            $em->flush();

            $questiontext = $request->request->get("question");
            $questionId = $request->request->get("quesId");
            $answer1 = $request->request->get("answer1");
            $answer1id = $request->request->get("answer1id");
            $answer2 = $request->request->get("answer2");
            $answer2id = $request->request->get("answer2id");
            $answer3 = $request->request->get("answer3");
            $answer3id = $request->request->get("answer3id");
            $answer4 = $request->request->get("answer4");
            $answer4id = $request->request->get("answer4id");
            for ($i = 0; $i < count($questiontext); $i++) {
               if (isset($questionId[$i]) && $questionId[$i] <> "" && trim($questiontext[$i]) <> "") {
                  $questionentity = $em->getRepository('DroidInfotechDroidBundle:Question')->findOneBy(array('id' => $questionId[$i]));
                  $questionentity->setText($questiontext[$i]);
                  $questionentity->setSurveys($survey);
                  $questionentity->setCreatedOn(new \DateTime());
                  $em->persist($questionentity);
                  $em->flush();

                  if (!empty($answer1) && $answer1id[$i] <> "" && trim($answer1[$i]) <> "") {
                     $answerentity1 = $em->getRepository('DroidInfotechDroidBundle:Answer')->findOneBy(array('id' => $answer1id[$i]));
                     if ($answerentity1) {
                        $answerentity1->setText($answer1[$i]);
                        $answerentity1->setQuestions($questionentity);
                        $answerentity1->setCreatedOn(new \DateTime());
                        $em->persist($answerentity1);
                        $em->flush();
                     } else if (trim($answer1[$i]) <> "") {
                        $answerentity1->setText($answer1[$i]);
                        $answerentity1->setQuestions($questionentity);
                        $answerentity1->setCreatedOn(new \DateTime());
                        $em->persist($answerentity1);
                        $em->flush();
                     }
                  }

                  if (!empty($answer2) && $answer2id[$i] <> "" && trim($answer2[$i]) <> "") {
                     $answerentity1 = $em->getRepository('DroidInfotechDroidBundle:Answer')->findOneBy(array('id' => $answer2id[$i]));
                     if ($answerentity1) {
                        $answerentity1->setText($answer2[$i]);
                        $answerentity1->setQuestions($questionentity);
                        $answerentity1->setCreatedOn(new \DateTime());
                        $em->persist($answerentity1);
                        $em->flush();
                     } else if (trim($answer2[$i]) <> "") {
                        $answerentity1->setText($answer2[$i]);
                        $answerentity1->setQuestions($questionentity);
                        $answerentity1->setCreatedOn(new \DateTime());
                        $em->persist($answerentity1);
                        $em->flush();
                     }
                  }

                  if (!empty($answer3) && $answer3id[$i] <> "" && trim($answer3[$i]) <> "") {
                     $answerentity1 = $em->getRepository('DroidInfotechDroidBundle:Answer')->findOneBy(array('id' => $answer3id[$i]));
                     if ($answerentity1) {
                        $answerentity1->setText($answer3[$i]);
                        $answerentity1->setQuestions($questionentity);
                        $answerentity1->setCreatedOn(new \DateTime());
                        $em->persist($answerentity1);
                        $em->flush();
                     } else if (trim($answer3[$i]) <> "") {
                        $answerentity1->setText($answer3[$i]);
                        $answerentity1->setQuestions($questionentity);
                        $answerentity1->setCreatedOn(new \DateTime());
                        $em->persist($answerentity1);
                        $em->flush();
                     }
                  }

                  if (!empty($answer4) && $answer4id[$i] <> "" && trim($answer4[$i]) <> "") {
                     $answerentity1 = $em->getRepository('DroidInfotechDroidBundle:Answer')->findOneBy(array('id' => $answer4id[$i]));
                     if ($answerentity1) {
                        $answerentity1->setText($answer4[$i]);
                        $answerentity1->setQuestions($questionentity);
                        $answerentity1->setCreatedOn(new \DateTime());
                        $em->persist($answerentity1);
                        $em->flush();
                     } else if (trim($answer4[$i]) <> "") {
                        $answerentity1->setText($answer4[$i]);
                        $answerentity1->setQuestions($questionentity);
                        $answerentity1->setCreatedOn(new \DateTime());
                        $em->persist($answerentity1);
                        $em->flush();
                     }
                  }
               } else if (trim($questiontext[$i]) <> "") {
                  $questionentity = new Question();
                  $questionentity->setText($questiontext[$i]);
                  $questionentity->setSurveys($survey);
                  $questionentity->setCreatedOn(new \DateTime());
                  $em->persist($questionentity);
                  $em->flush();
                  if (!empty($answer1) && trim($answer1[$i]) <> "") {
                     $answerentity1 = new Answer();
                     $answerentity1->setText($answer1[$i]);
                     $answerentity1->setQuestions($questionentity);
                     $answerentity1->setCreatedOn(new \DateTime());
                     $em->persist($answerentity1);
                     $em->flush();
                  }

                  if (!empty($answer2) && trim($answer2[$i]) <> "") {
                     $answerentity1 = new Answer();

                     $answerentity1->setText($answer2[$i]);
                     $answerentity1->setQuestions($questionentity);
                     $answerentity1->setCreatedOn(new \DateTime());
                     $em->persist($answerentity1);
                     $em->flush();
                  }

                  if (!empty($answer3) && $answer3[$i] <> "") {
                     $answerentity1 = new Answer();
                     $answerentity1->setText($answer3[$i]);
                     $answerentity1->setQuestions($questionentity);
                     $answerentity1->setCreatedOn(new \DateTime());
                     $em->persist($answerentity1);
                     $em->flush();
                  }

                  if (!empty($answer4) && trim($answer4[$i]) <> "") {
                     $answerentity1 = new Answer();
                     $answerentity1->setText($answer4[$i]);
                     $answerentity1->setQuestions($questionentity);
                     $answerentity1->setCreatedOn(new \DateTime());
                     $em->persist($answerentity1);
                     $em->flush();
                  }
               }
            }
            return $this->redirectToRoute('survey_index');
         } else {
            $error = "A survey is already activated for this event.";
         }
      }

      $res = $em->getRepository('DroidInfotechDroidBundle:Question')->findBySurveys($survey);
      $surveys = $res;
      $ans = [];
      $ques = [];

      foreach ($res as $ress1) {
         $questionids = $ress1->getId();
         $res2 = $em->getRepository('DroidInfotechDroidBundle:Answer')->findByQuestions($ress1);
         $questionids = rtrim($questionids, ',');
         $ques[] = $ress1;
         foreach ($res2 as $res22) {
            $ans[$questionids][] = $res22->getText();
            $ans[$questionids]['ansId'][] = $res22->getId();
         }
      }

      return $this->render('survey/edit.html.twig', array(
                  'survey' => $survey,
                  'edit_form' => $editForm->createView(),
                  'delete_form' => $deleteForm->createView(),
                  'error' => $error,
                  'ques' => $ques,
                  'ans' => $ans,
      ));
   }

   /**
    * Deletes a Survey entity.
    *
    * @Route("/{id}", name="survey_delete")
    * @Method("DELETE")
    */
   public function deleteAction(Request $request, Survey $survey) {
      $form = $this->createDeleteForm($survey);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
         $em = $this->getDoctrine()->getManager();
         $em->remove($survey);
         $em->flush();
      }

      return $this->redirectToRoute('survey_index');
   }

   /**
    * Creates a form to delete a Survey entity.
    *
    * @param Survey $survey The Survey entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
   private function createDeleteForm(Survey $survey) {
      return $this->createFormBuilder(array(), array('csrf_token_id' => 'authenticate'))
                      ->setAction($this->generateUrl('survey_delete', array('id' => $survey->getId())))
                      ->setMethod('DELETE')
                      ->getForm()
      ;
   }

   /**
    * mobile a Survey entity.
    *
    * @Route("/mobilesurvey/{survey_id}/{token}/{offset}", name="mobile_survey")
    * @Method({"GET","POST"})
    */
   public function mobileSurveyAction(Request $request, $survey_id, $token, $offset = 0) {
      $userdata = $request->getSession()->get('userdata');
      $em = $this->getDoctrine()->getManager();
      $users = $em->getRepository('DroidInfotechDroidBundle:Log')->findOneBy(array('userToken' => $token));
      $status_code = 0;
      $message = "No Record Found";
      $data = array();

      if (!$users) {
         $status_code = 0;
         $message = "Not Valid Token";
         $data = array();
         $description = '';
         return $this->render(
                         'survey/mobilesurvey.html.twig', array(
                     'error' => $message,
                         )
         );
      } else {
         $message = "";
         $em = $this->getDoctrine()->getManager();
         if ($request->isMethod('POST')) {
            $questionId = $request->request->get("questionId");
            $answerId = $request->request->get("answer");
            $savedsurvey_rec = $em->getRepository('DroidInfotechDroidBundle:SavedSurvey')->findOneBy(array('userId' => $users->getUserId(), 'questionId' => $questionId, 'surveyId' => $survey_id));
            if (!$savedsurvey_rec) {
               $surveydet = $em->getRepository('DroidInfotechDroidBundle:Survey')->findOneBy(array('id' => $survey_id));
               $quesdet = $em->getRepository('DroidInfotechDroidBundle:Question')->findOneBy(array('id' => $questionId));
               $ansdet = $em->getRepository('DroidInfotechDroidBundle:Answer')->findOneBy(array('id' => $answerId));
               $SavedSurveyEntity = new SavedSurvey();
               $SavedSurveyEntity->setSurveytitle($surveydet->getTitle());
               $SavedSurveyEntity->setSurveydesc($surveydet->getDescriptions());
               $SavedSurveyEntity->setQuestion($quesdet->getText());
               $SavedSurveyEntity->setAnswer($ansdet->getText());
               $SavedSurveyEntity->setUserId($users->getUserId());
               $SavedSurveyEntity->setQuestionId($questionId);
               $SavedSurveyEntity->setAnswerId($answerId);
               $SavedSurveyEntity->setSurveyId($survey_id);
               $SavedSurveyEntity->setCreatedOn(new \DateTime());
               $em->persist($SavedSurveyEntity);
               $em->flush();
            }
         }
         $st = $offset;
         $limit = 1;
         $sql = 'SELECT ques.id FROM DroidInfotechDroidBundle:Question
                     ques where ques.surveys=' . $survey_id;
         $ques_count = $em->createQuery($sql)->getResult();
         $questcount = count($ques_count);

         $dql = 'SELECT ques.id,ques.text as question FROM DroidInfotechDroidBundle:Question
                     ques where ques.surveys=' . $survey_id;
         $ques_result = $em->createQuery($dql)->setFirstResult($st)->setMaxResults($limit)->getResult();
         if ($ques_result) {
            $cnt = 0;
            foreach ($ques_result as $ques_results) {
               $cnt++;
               $dql = 'SELECT ans.id,ans.text as answer FROM DroidInfotechDroidBundle:Answer
                     ans where ans.questions=' . $ques_results['id'];
               $ans_result = $em->createQuery($dql)->getResult();
            }

            $newoffset = $offset + 1;

            return $this->render(
                            'survey/mobilesurvey.html.twig', array(
                        'survey_id' => $survey_id,
                        'quest' => $ques_result,
                        'ans' => $ans_result,
                        'token' => $token,
                        'questcount' => $questcount,
                        'offset' => $newoffset
                            )
            );
         } else {
            return $this->render(
                            'survey/thank.html.twig', array(
                        'survey_id' => $survey_id,
                        'token' => $token,
                            )
            );
         }
      }
   }

   /**
    * mobile a Survey entity.
    *
    * @Route("/intro/{token}/{eventId}/{offset}", name="intro_survey")
    * @Method("GET")
    */
   public function introSurveyAction(Request $request, $token, $eventId, $offset = 0) {
      $userdata = $request->getSession()->get('userdata');
      $em = $this->getDoctrine()->getManager();
      $users = $em->getRepository('DroidInfotechDroidBundle:Log')->findByUserToken($token);
      $status_code = 0;
      $description = "";
      $message = "No Record Found";
      $data = array();
      if (!$users) {
         $status_code = 0;
         $message = "Not Valid Token";
         $data = array();
         $description = '';
         return $this->render(
                         'survey/intro.html.twig', array(
                     'error' => $message,
                         )
         );
      } else if (trim($eventId) == "") {
         $status_code = 0;
         $message = "EventId is missing";
         $data = array();
      } else {

         $message = "";
         $em = $this->getDoctrine()->getManager();
         $dql = "SELECT sur.descriptions,sur.id FROM DroidInfotechDroidBundle:Survey sur where sur.active=1 and sur.eventId='" . $eventId . "'";
         $result = $em->createQuery($dql)->setMaxResults(1)->getResult();
         if ($result) {
            $description = $result[0]['descriptions'];
            $survey_id = $result[0]['id'];
            $savedsurvey_rec = $em->getRepository('DroidInfotechDroidBundle:SavedSurvey')->findBy(array('userId' => $users[0]->getUserId(), 'surveyId' => $survey_id));
            $savedcount = count($savedsurvey_rec);
            $sql = 'SELECT ques.id FROM DroidInfotechDroidBundle:Question
                     ques where ques.surveys=' . $survey_id;
            $ques_count = $em->createQuery($sql)->getResult();
            $questcount = count($ques_count);
            if ($questcount > $savedcount) {
               return $this->render(
                               'survey/intro.html.twig', array(
                           'intro' => $description,
                           'token' => $token,
                           'survey_id' => isset($survey_id) ? $survey_id : 0,
                           'offset' => isset($offset) ? $offset : 0
                               )
               );
            } else {
               $message = "You have already taken this Survey.";
               return $this->render(
                               'survey/intro.html.twig', array('intro' => $description,
                           'error' => $message,
                           'survey_id' => isset($survey_id) ? $survey_id : 0, 'token' => $token, 'offset' => isset($offset) ? $offset : 0
               ));
            }
         } else {
            $message = "No Survey Available at the moment, please check again later";
            return $this->render(
                            'survey/intro.html.twig', array(
                        'error' => $message,
            ));
         }
      }
   }

   /**
    * mobile a Survey entity.
    *
    * @Route("/attempted", name="attempted_survey")
    * @Method("POST")
    */
   public function CheckAttemptedSurveyAction(Request $request) {
      $token = $request->request->get("token");
      $eventId = $request->request->get("eventId");
      $em = $this->getDoctrine()->getManager();
      $users = $em->getRepository('DroidInfotechDroidBundle:Log')->findByUserToken($token);
      $status_code = 0;
      $description = "";
      $message = "No Record Found";
      $data = array();
      if (!$users) {
         $status_code = 0;
         $message = "Not Valid Token";
         $data = array();
         $description = '';
      } else if (trim($eventId) == "") {
         $status_code = 0;
         $message = "EventId is missing";
         $data = array();
      } else {
         $dql = "SELECT sur.descriptions,sur.id FROM DroidInfotechDroidBundle:Survey sur where sur.active=1 and sur.eventId='" . $eventId . "'";
         $result = $em->createQuery($dql)->setMaxResults(1)->getResult();
         if ($result) {
            $status_code = 1;
            $description = $result[0]['descriptions'];
            $survey_id = $result[0]['id'];
            $savedsurvey_rec = $em->getRepository('DroidInfotechDroidBundle:SavedSurvey')->findBy(array('userId' => $users[0]->getUserId(), 'surveyId' => $survey_id));
            $totalattempted = count($savedsurvey_rec);
            $sql = 'SELECT ques.id FROM DroidInfotechDroidBundle:Question
                     ques where ques.surveys=' . $survey_id;
            $ques_count = $em->createQuery($sql)->getResult();
            $totalquestion = count($ques_count);
            $data = array('totalquestion' => $totalquestion, 'totalattempted' => $totalattempted);
            $message = "Survey Question attempted details";
         }
      }
      $json = json_encode(array(
          'message' => $message,
          'data' => $data,
          'status_code' => $status_code
              ), JSON_UNESCAPED_SLASHES);
      return new Response($json, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'application/json'));
   }

   /**
    * Export survey results
    * @Route("/results/export.{_format}",defaults={"_format"="xls"}, requirements={"_format"="csv|xls|xlsx"},name="suvey_export_results")
    * @Template("survey/surveyexport.xlsx.twig")
    * @Method({"GET", "POST"})
    */
   public function resultsexportAction(Request $request) {
      $user = new User();
      $em = $this->getDoctrine()->getManager();
      $dql = "SELECT a FROM DroidInfotechDroidBundle:User a WHERE (a.roles like '%ROLE_APPUSER%') and a.email <> ''";
      $allusers = $em->createQuery($dql)->getResult();

      /** Get list of all surveys * */
      $sqlForSurveys = "Select sr.title,sr.id "
              . "From DroidInfotechDroidBundle:Survey sr join DroidInfotechDroidBundle:events e with sr.eventId=e.id ";
      $allSurveys = $em->createQuery($sqlForSurveys)->getResult();

      $surveybyuser = array();
      $userSurveyRecord = array();
      $totalsurveycount = -1;
      $getsurvey = 0;
      if ($request->isMethod('POST')) {
         $export = $request->request->get('export');
         if ($export) {
            $surveyToExport = $request->request->get('survey');
            $dqlSurveyQuestions = "SELECT s.title,a.text as optiontext,a.id as optionid,q.text as question,e.title as eventTitle ,s.title as surveyTitle,q.id as questionid "
                    . "FROM DroidInfotechDroidBundle:Survey s "
                    . "JOIN DroidInfotechDroidBundle:Events e with s.eventId=e.id "
                    . "JOIN DroidInfotechDroidBundle:Question  q with q.surveys=s.id "
                    . "JOIN DroidInfotechDroidBundle:Answer a with q.id=a.questions "
                    . "WHERE s.id = '{$surveyToExport}'";
            $surveyQuestionsData = $em->createQuery($dqlSurveyQuestions)->getResult();
            // answers to questions
            $dqlSurveyToExport = "SELECT a.id as optionid, sr.userId "
                    . "FROM DroidInfotechDroidBundle:SavedSurvey sr "
                    . "JOIN DroidInfotechDroidBundle:Survey s with s.id=sr.surveyId AND sr.surveyId = '{$surveyToExport}' "
                    . "JOIN DroidInfotechDroidBundle:Answer a with a.id=sr.answerId "
                    . "JOIN DroidInfotechDroidBundle:Question  q with q.id=sr.questionId ";
            $surveyData = $em->createQuery($dqlSurveyToExport)->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            // get total count of users who have taken part in survey
            $optionsResponseCount = array();
            $surveyDetails = array();
            $participatedUsers = array();

            /** Get response count for each option in the survey * */
            foreach ($surveyData as $row) {
               if (!isset($optionsResponseCount[$row['optionid']])) {
                  $optionsResponseCount[$row['optionid']] = 0;
               }
               $optionsResponseCount[$row['optionid']] = $optionsResponseCount[$row['optionid']] + 1;
               $participatedUsers[] = $row['userId'];
            }

            /** Refine data for * */
            foreach ($surveyQuestionsData as $resultRow) {
               $surveyDetails['questionsData'][$resultRow['questionid']]['question'] = $resultRow['question'];
               $optionResponseCount = (isset($optionsResponseCount[$resultRow['optionid']])) ? $optionsResponseCount[$resultRow['optionid']] : 0;
               $surveyDetails['questionsData'][$resultRow['questionid']]['responses'][$resultRow['optionid']] = array('optionText' => $resultRow['optiontext'], 'optionCount' => $optionResponseCount);
            }

            $surveyDetails['surveyTitle'] = $surveyQuestionsData[0]['surveyTitle'];
            $surveyDetails['eventTitle'] = $surveyQuestionsData[0]['eventTitle'];
            $surveyDetails['totalNumberOfUsers'] = count(array_unique($participatedUsers));
            $filename = "export_" . date("Y_m_d_His") . ".xlsx";
            // $response->headers->set('Content-Type', 'application/vnd.ms-excel');
            // $response->headers->set('Content-Disposition', 'attachment; filename=' . $filename);
            return $surveyDetails;
         }
      }
   }

   /**
    * Creates a new Survey entity.
    *
    * @Route("/results", name="survey_results")
    * @Method({"GET", "POST"})
    */
   public function resultsAction(Request $request) {
      $user = new User();
      $em = $this->getDoctrine()->getManager();
      $dql = "SELECT a FROM DroidInfotechDroidBundle:User a WHERE (a.roles like '%ROLE_APPUSER%') and a.email <> ''";
      $allusers = $em->createQuery($dql)->getResult();

      /** Get list of all surveys * */
      $sqlForSurveys = "Select sr.title,sr.id "
              . "From DroidInfotechDroidBundle:Survey sr join DroidInfotechDroidBundle:events e with sr.eventId=e.id ";
      $allSurveys = $em->createQuery($sqlForSurveys)->getResult();

      $surveybyuser = array();
      $userSurveyRecord = array();
      $totalsurveycount = -1;
      $getsurvey = 0;
      if ($request->isMethod('POST')) {


         $export = $request->request->get('export');
         if ($export) {

            $surveyToExport = $request->request->get('survey');

            $dqlSurveyQuestions = "SELECT s.title,a.text as optiontext,a.id as optionid,q.text as question,e.title as eventTitle ,s.title as surveyTitle,q.id as questionid "
                    . "FROM DroidInfotechDroidBundle:Survey s "
                    . "JOIN DroidInfotechDroidBundle:Events e with s.eventId=e.id "
                    . "JOIN DroidInfotechDroidBundle:Question  q with q.surveys=s.id "
                    . "JOIN DroidInfotechDroidBundle:Answer a with q.id=a.questions "
                    . "WHERE s.id = '{$surveyToExport}'";
            $surveyQuestionsData = $em->createQuery($dqlSurveyQuestions)->getResult();

            // answers to questions
            $dqlSurveyToExport = "SELECT a.id as optionid, sr.userId "
                    . "FROM DroidInfotechDroidBundle:SavedSurvey sr "
                    . "JOIN DroidInfotechDroidBundle:Survey s with s.id=sr.surveyId AND sr.surveyId = '{$surveyToExport}' "
                    . "JOIN DroidInfotechDroidBundle:Answer a with a.id=sr.answerId "
                    . "JOIN DroidInfotechDroidBundle:Question  q with q.id=sr.questionId ";


            $surveyData = $em->createQuery($dqlSurveyToExport)->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);


            // get total count of users who have taken part in survey


            $optionsResponseCount = array();
            $surveyDetails = array();
            $participatedUsers = array();

            /** Get response count for each option in the survey * */
            foreach ($surveyData as $row) {
               if (!isset($optionsResponseCount[$row['optionid']])) {
                  $optionsResponseCount[$row['optionid']] = 0;
               }
               $optionsResponseCount[$row['optionid']] = $optionsResponseCount[$row['optionid']] + 1;
               $participatedUsers[] = $row['userId'];
            }

            /** Refine data for * */
            foreach ($surveyQuestionsData as $resultRow) {
               $surveyDetails['questionsData'][$resultRow['questionid']]['question'] = $resultRow['question'];
               $optionResponseCount = (isset($optionsResponseCount[$resultRow['optionid']])) ? $optionsResponseCount[$resultRow['optionid']] : 0;
               $surveyDetails['questionsData'][$resultRow['questionid']]['responses'][$resultRow['optionid']] = array('optionText' => $resultRow['optiontext'], 'optionCount' => $optionResponseCount);
            }

            $surveyDetails['surveyTitle'] = $surveyQuestionsData[0]['surveyTitle'];
            $surveyDetails['eventTitle'] = $surveyQuestionsData[0]['eventTitle'];
            $surveyDetails['totalNumberOfUsers'] = count(array_unique($participatedUsers));
            $filename = "export_" . date("Y_m_d_His") . ".xlsx";
            $response = $this->render('survey/surveyexport.xlsx.twig', $surveyDetails);

            #--debug
            print_r($response);
            die;


            // $response->headers->set('Content-Type', 'application/vnd.ms-excel');
            // $response->headers->set('Content-Disposition', 'attachment; filename=' . $filename);
            return $response;
         } else {
            $userid = $request->request->get("user_name");
            //$formvalue="Form has been submitted".$username;
            $dqlsurveybyuser = "Select sr.surveyId,sr.question,sr.surveytitle,sr.answer,u.email,e.title as eventTitle "
                    . "FROM DroidInfotechDroidBundle:SavedSurvey sr "
                    . "JOIN DroidInfotechDroidBundle:User u WITH sr.userId=u.id "
                    . "JOIN DroidInfotechDroidBundle:Survey s WITH sr.surveyId=s.id "
                    . "JOIN DroidInfotechDroidBundle:events e WITH e.id=s.eventId "
                    . "WHERE u.id=" . $userid;
            $surveybyuser = $em->createQuery($dqlsurveybyuser)->getResult();

            $userSurveyRecord = array();

            foreach ($surveybyuser as $surveyRecord) {
               $userSurveyRecord[$surveyRecord['surveyId']][] = $surveyRecord;
            }


            $totalsurveycount = count($surveybyuser);
            $getsurvey = 1;
         }
      }

      return $this->render('survey/results.html.twig', array(
                  'allusers' => $allusers,
                  "usersurvey" => $userSurveyRecord,
                  "surveycount" => $totalsurveycount,
                  "getsurvey" => $getsurvey,
                  "allSurveys" => $allSurveys,
      ));
   }

}
