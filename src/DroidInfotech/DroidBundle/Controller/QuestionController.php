<?php

namespace DroidInfotech\DroidBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DroidInfotech\DroidBundle\Entity\Question;
use DroidInfotech\DroidBundle\Form\QuestionType;

/**
 * Question controller.
 *
 * @Route("/question")
 */
class QuestionController extends Controller {

   /**
    * Lists all Question entities.
    *
    * @Route("/", name="question_index")
    * @Method("GET")
    */
   public function indexAction() {
      $em = $this->getDoctrine()->getManager();

      $questions = $em->getRepository('DroidInfotechDroidBundle:Question')->findAll();

      return $this->render('question/index.html.twig', array(
                  'questions' => $questions,
      ));
   }

   /**
    * Creates a new Question entity.
    *
    * @Route("/new", name="question_new")
    * @Method({"GET", "POST"})
    */
   public function newAction(Request $request) {
      $question = new Question();
      $form = $this->createForm('DroidInfotech\DroidBundle\Form\QuestionType', $question);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
         $em = $this->getDoctrine()->getManager();
         $em->persist($question);
         $em->flush();

         return $this->redirectToRoute('question_show', array('id' => $question->getId()));
      }

      return $this->render('question/new.html.twig', array(
                  'question' => $question,
                  'form' => $form->createView(),
      ));
   }

   /**
    * Displays a form to edit an existing Question entity.
    *
    * @Route("/{id}/edit", name="question_edit")
    * @Method({"GET", "POST"})
    */
   public function editAction(Request $request, Question $question) {
      $deleteForm = $this->createDeleteForm($question);
      $editForm = $this->createForm('DroidInfotech\DroidBundle\Form\QuestionType', $question);
      $editForm->handleRequest($request);

      if ($editForm->isSubmitted() && $editForm->isValid()) {
         $em = $this->getDoctrine()->getManager();
         $em->persist($question);
         $em->flush();

         return $this->redirectToRoute('question_edit', array('id' => $question->getId()));
      }

      return $this->render('question/edit.html.twig', array(
                  'question' => $question,
                  'edit_form' => $editForm->createView(),
                  'delete_form' => $deleteForm->createView(),
      ));
   }

   /**
    * Deletes a Question entity.
    *
    * @Route("/{id}", name="question_delete")
    * @Method("DELETE")
    */
   public function deleteAction(Request $request, Question $question) {
      $form = $this->createDeleteForm($question);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
         $em = $this->getDoctrine()->getManager();
         $em->remove($question);
         $em->flush();
      }

      return $this->redirectToRoute('question_index');
   }

   /**
    * Creates a form to delete a Question entity.
    *
    * @param Question $question The Question entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
   private function createDeleteForm(Question $question) {
      return $this->createFormBuilder()
                      ->setAction($this->generateUrl('question_delete', array('id' => $question->getId())))
                      ->setMethod('DELETE')
                      ->getForm()
      ;
   }

   /**
    * remove a Question .
    *
    * @Route("/deletequestion/{questionId}/answer", name="question_answer_delete")
    * @Method("GET")
    */
   public function removeSurveyQuestionAction($questionId) {
      $status_code = 0;
      $message = "No Record Found";
      $data = array();
      if ($questionId <> "" && $questionId != "undefined") {
         $em = $this->getDoctrine()->getManager();
         $question = $em->getRepository('DroidInfotechDroidBundle:Question')->findById($questionId);
         $queryBuilder = $em
                 ->createQueryBuilder()
                 ->delete('DroidInfotechDroidBundle:Answer', 'a')
                 ->where('a.questions = :parent')
                 ->setParameter('parent', $question);
         $queryBuilder->getQuery()->execute();
         $queryBuilder = $em
                 ->createQueryBuilder()
                 ->delete('DroidInfotechDroidBundle:Question', 'a')
                 ->where('a.id = :parent')
                 ->setParameter('parent', $questionId);
         $queryBuilder->getQuery()->execute();
 
         
         $suveryId = $question[0]->getSurveys()->getId();
  

         $queryBuilder = $em
                 ->createQueryBuilder()
                 ->delete('DroidInfotechDroidBundle:SavedSurvey', 'a')
                 ->where('a.surveyId = :parent')
                 ->setParameter('parent', $suveryId);
         $queryBuilder->getQuery()->execute();


         $message = "Removed Successfully !";
         $status_code = 1;
      }
      $json = json_encode(array(
          'message' => $message,
          'data' => $data,
          'status_code' => $status_code
              ), JSON_UNESCAPED_SLASHES);
      return new Response($json, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'application/json'));
   }

}
