<?php

namespace DroidInfotech\DroidBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DroidInfotech\DroidBundle\Entity\User;
use DroidInfotech\DroidBundle\Entity\Log;
use DroidInfotech\DroidBundle\Entity\Device;
use DroidInfotech\DroidBundle\Form\UserType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
/**
 * 
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller {

   /**
    * Lists all User entities.
    *
    * @Route("/", name="user_index")
    * @Method("GET")
    * 
    */
   public function indexAction(Request $request) {

      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $user = new User();
      $em = $this->getDoctrine()->getManager();
      $dql = "SELECT a FROM DroidInfotechDroidBundle:User a ";
      $form = $this->createForm('DroidInfotech\DroidBundle\Form\UserType', $user);
      $form->handleRequest($request);
      if ($request->isMethod('POST')) {

         $dqls = array();
         if ($user->getUsername()) {
            $dqls[] = " a.name like '" . $user->getName() . "%'";
         }
         if ($user->getPhone()) {
            $dqls[] = " a.email like '" . $user->getEmail() . "%'";
         }
         if (!empty($dqls)) {
            $dql.= "WHERE (a.roles like '%[\"ROLE_USER%' || a.roles like '%[\"ROLE_ADMIN%')";
         }
      }
      $dql.= "WHERE (a.roles NOT like '%ROLE_APPUSER%')";
      // echo $dql;die;
      $query = $em->createQuery($dql);
      $paginator = $this->get('knp_paginator');
      $pagination = $paginator->paginate(
              $query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
      );

      return $this->render('user/index.html.twig', array(
                  'pagination' => $pagination,
                  'form' => $form->createView()
      ));
   }

   /**
    * Displays a form to edit an existing User entity.
    *
    * @Route("/new", name="user_new")
    * @Method({"GET", "POST"})
    */
   public function newAction(Request $request) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $user = new User();
      $form = $this->createForm('DroidInfotech\DroidBundle\Form\UserType', $user);
      $form->handleRequest($request);
      $error = array();
      if ($form->isSubmitted() && $form->isValid()) {
         $em = $this->getDoctrine()->getManager();
         $formelement = $request->request->get('user');
         $email = $formelement['email'];
         if ($email <> "") {
            $users = $em->getRepository('DroidInfotechDroidBundle:User')->findBy(array("email" => $email, "roles" => "<> 'ROLE_APPUSER'"));

            if ($users) {
               $error[] = "This user is already registered";
            } else {
               $encoder = $this->container->get('security.password_encoder');

               $encoded = $encoder->encodePassword($user, $formelement['password']['first']);
               $user->setCreatedOn(new \DateTime("now"));
               $user->setPassword($encoded);
               $user->setRoles(array('ROLE_USER'));

               $em->persist($user);
               $em->flush();
               $this->addFlash(
                       'success', sprintf('created by you: %s!', $user->getEmail())
               );
               return $this->redirectToRoute('user_index');
            }
         }
      }

      return $this->render('user/new.html.twig', array(
                  'user' => $user,
                  'form' => $form->createView(),
                  'error' => implode(",", $error)
      ));
   }

   /**
    * Displays a form to edit an existing User entity.
    *
    * @Route("/{id}/edit", name="user_edit")
    * @Method({"GET", "POST"})
    */
   public function editAction(Request $request, User $user) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $error = array();
      $deleteForm = $this->createDeleteForm($user);
      $editForm = $this->createForm('DroidInfotech\DroidBundle\Form\UserType', $user);
      $editForm->handleRequest($request);
      if ($editForm->isSubmitted() && $editForm->isValid()) {
         $em = $this->getDoctrine()->getManager();
         $formelement = $request->request->get('user');
         $email = $formelement['email'];
         if ($email <> "") {
            $users = $em->getRepository('DroidInfotechDroidBundle:User')->findBy(array('email' => $email));
            $flg = false;
            foreach ($users as $userss) {
               if ($userss->getId() != $user->getId()) {
                  $flg = true;
                  break;
               }
            }
            if ($flg) {
               $error[] = "This user is already registered";
            } else {

               $encoder = $this->container->get('security.password_encoder');
               $encoded = $encoder->encodePassword($user, $formelement['password']['first']);
               $user->setPassword($encoded);

               $em->persist($user);
               $em->flush();
               return $this->redirectToRoute('user_index');
            }
         }
      }

      return $this->render('user/edit.html.twig', array(
                  'user' => $user,
                  'edit_form' => $editForm->createView(),
                  'delete_form' => $deleteForm->createView(),
                  'error' => implode(",", $error)
      ));
   }

   /**
    * Deletes a User entity.
    *
    * @Route("/{id}", name="user_delete")
    * @Method("GET")
    */
   public function deleteAction(User $user, Request $request) {
      
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $form = $this->createDeleteForm($user);
      $form->handleRequest($request);
      $em = $this->getDoctrine()->getManager();
      $em->remove($user);
      $em->flush();
      return $this->redirect($request->headers->get('referer'));
   }

   /**
    * Creates a form to delete a User entity.
    *
    * @param User $user The User entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
   private function createDeleteForm(User $user) {
      return $this->createFormBuilder()
                      ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
                      ->setMethod('DELETE')
                      ->getForm()
      ;
   }

   /* login webservice */

   public function loginAction(Request $request) {
      $content=$this->getContentAsArray($request);
     // $request->request=$content;
      $user = new User();
      $email = $content['email'];//$request->request->get("email");
      $password =$content['password'];// $request->request->get("password");
      $devicetoken =$content['devicetoken'];// $request->request->get("devicetoken");
      $devicetype = $content['devicetype'];//$request->request->get("devicetype");
      $message = "";
      $success = "";
      $status_code = 0;
      $data = [];
      if (trim($email) == "" || trim($password) == "") {
         $message.="Please enter your email and password";
      } else {

         $user = new User();
         $em = $this->getDoctrine()->getManager();
         $encoder = $this->container->get('security.password_encoder');
         $encoded = $encoder->encodePassword($user, $password);

         $objQueryBuilder = $em->createQueryBuilder();

         /** Find if user already exists with email , That email can exixts in app* */
         $sqlToExecute = $objQueryBuilder->select(array('u'))
                 ->from('DroidInfotechDroidBundle:User', 'u')
                 ->where(
                 $objQueryBuilder->expr()->andX(
                         $objQueryBuilder->expr()->eq('u.roles', '?1'), $objQueryBuilder->expr()->eq('u.email', '?2')
         ));

         $objQueryBuilder->setParameters(array(1 => '["ROLE_APPUSER"]', 2 => $email));
         $users = $sqlToExecute->getQuery()->getResult();

         if (isset($users[0]) && $users[0]->getPassword() == $encoded) {
            $message.="LoggedIn successfully";
            $token = $this->getTokens(5);
            ;
            $status_code = 1;
            $datetime = new \DateTime("now");
            $date = $datetime->format('Y') . "-" . $datetime->format('m') . "-" . $datetime->format('d');
            $checkin_status = 1;
            $qb = $em->createQueryBuilder();
            $q = $qb->update('DroidInfotech\DroidBundle\Entity\User', 'u')
                    ->set('u.facebookToken', '?2')
                    ->where('u.id = ?3')
                    ->setParameter(2, $token)
                    ->setParameter(3, $users[0]->getId())
                    ->getQuery();
            $p = $q->execute();
            $em->flush();
            $log = new Log;
            $log->setCreatedOn(new \DateTime());
            $log->setUserToken($token);
            $log->setUserId($users[0]->getId());
            $em->persist($log);
            $em->flush();
            $this->saveDevicetoken($devicetoken, $devicetype, $users[0]->getId());
            //$request->session->set('token', $value);
            $data = array('userId' => $users[0]->getId(), 'email' => $users[0]->getEmail(), 'name' => $users[0]->getName(), 'token' => $token);
            $request->getSession()->set('userdata', $data);
         } else {
            $message.="Invalid login";
         }
      }
      $json = json_encode(array(
          'message' => $message,
          'data' => $data,
          'status_code' => $status_code
              ), JSON_UNESCAPED_SLASHES);
      return new Response($json, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'application/json'));
   }
   
   protected function getContentAsArray(Request $request){
    $content = $request->getContent();
    if(empty($content)){
        throw new BadRequestHttpException("Content is empty");
    }
    return new ArrayCollection(json_decode($content, true));
    
}

   /* sign up webservice */

   public function signupAction(Request $request) {
       $content=$this->getContentAsArray($request);
      // $request->request=$content;
      $username =$content["email"];
      $password = $content["password"];
      $name = $content["name"];
      $email =$content["email"];
      $mobile = $content["mobile"];
      $devicetoken = $content["devicetoken"];
      $devicetype = $content["devicetype"];
      $role=$content['role'];
      $message = "";
      $success = "";
      $data = [];
      $status_code = 0;
      $token = $this->getTokens(5);
      if (trim($email) == "" || trim($password) == "" || trim($role)=="") {
         $message.=" Please fill the required field !";
      } else {

         $user = new User();
         $em = $this->getDoctrine()->getManager();
         $encoder = $this->container->get('security.password_encoder');
         $encoded = $encoder->encodePassword($user, $password);
         $objQueryBuilder = $em->createQueryBuilder();

         /** Find if user already exists with email , That email can exixts in app* */
         $sqlToExecute = $objQueryBuilder->select(array('u'))
                 ->from('DroidInfotechDroidBundle:User', 'u')
                 ->where(
                 $objQueryBuilder->expr()->andX(
                         $objQueryBuilder->expr()->eq('u.roles', '?1'), $objQueryBuilder->expr()->eq('u.email', '?2')
         ));

         $objQueryBuilder->setParameters(array(1 => '['.$role.']', 2 => $email));
         $users = $sqlToExecute->getQuery()->getResult();
         
         if ($users) {
            $message.="This user is already registered, please tap on the forgot password link available on login screen to reset your password.";
         } else {
            $user->setCreatedOn(new \DateTime());
            $user->setUsername($email);
            $user->setName($name);
            $user->setMobile($mobile);
            $user->setEmail($email);
            $user->setPassword($encoded);
            $user->setRoles(array($role));
            $em->persist($user);
            $em->flush();
            $log = new Log;
            $log->setCreatedOn(new \DateTime());
            $log->setUserToken($token);
            $log->setUserId($user->getId());
            $em->persist($log);
            $em->flush();
            $this->saveDevicetoken($devicetoken, $devicetype, $user->getId());
            $data = array('userId' => $user->getId(), 'email' => $user->getEmail(), 'name' => $user->getName(), 'token' => $token,'devicetoken'=>$devicetoken,'devicetype'=>$devicetype);
            $request->getSession()->set('userdata', $data);
            $message.="Success";
            $status_code = 1;
         }
      }
      $json = json_encode(array(
          'message' => $message,
          'data' => $data,
          'status_code' => $status_code
              ), JSON_UNESCAPED_SLASHES);
      return new Response($json, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'application/json'));
   }

   public function facebookAction(Request $request) {
       $content=$this->getContentAsArray($request);
       $request->request=$content;
      $facebook_id = $request->request->get("facebook_id");
      $name = $request->request->get("name");
      $password = $request->request->get("password");
      $devicetoken = $request->request->get("devicetoken");
      $devicetype = $request->request->get("devicetype");
      $message = "";
      $success = "";
      $data = [];
      $status_code = 0;
      if (trim($facebook_id) == "") {
         $message.=" Please enter facebookId !";
      } else {
         $user = new User();
         $em = $this->getDoctrine()->getManager();
         $encoder = $this->container->get('security.password_encoder');
         $encoded = $encoder->encodePassword($user, $password);
         $users = $em->getRepository('DroidInfotechDroidBundle:User')->findByFacebookId($facebook_id);
         $token = $this->getTokens(5);
         if (isset($users[0])) {
            $message.="LoggedIn successfully";

            $status_code = 1;
            $datetime = new \DateTime("now");
            $date = $datetime->format('Y') . "-" . $datetime->format('m') . "-" . $datetime->format('d');
            $checkin_status = 1;
            $qb = $em->createQueryBuilder();
            $q = $qb->update('DroidInfotech\DroidBundle\Entity\User', 'u')
                    ->set('u.facebookToken', '?2')
                    ->where('u.id = ?3')
                    ->setParameter(2, $token)
                    ->setParameter(3, $users[0]->getId())
                    ->getQuery();
            $p = $q->execute();
            $em->flush();
            $log = new Log;
            $log->setCreatedOn(new \DateTime());
            $log->setUserToken($token);
            $log->setUserId($users[0]->getId());
            $em->persist($log);
            $em->flush();
            $this->saveDevicetoken($devicetoken, $devicetype, $users[0]->getId());
            //$request->session->set('token', $value);
            $data = array('userId' => $users[0]->getId(), 'facebookId' => $users[0]->getFacebookId(), 'name' => $users[0]->getName(), 'token' => $token);
            $request->getSession()->set('userdata', $data);
         } else {
            $user->setCreatedOn(new \DateTime());
            $user->setUsername($name);
            $user->setName($name);
            $user->setEmail('');
            $user->setPassword($encoded);
            $user->setFacebookId($facebook_id);
            $user->setFacebookToken($token);
            $user->setRoles(array('ROLE_APPUSER'));
            $em->persist($user);
            $em->flush();
            $log = new Log;
            $log->setCreatedOn(new \DateTime());
            $log->setUserToken($token);
            $log->setUserId($user->getId());
            $em->persist($log);
            $em->flush();
            $data = array('userId' => $user->getId(), 'facebookId' => $facebook_id, 'name' => $name, 'token' => $token);
            $request->getSession()->set('userdata', $data);
            $message.="LoggedIn successfully";
            $status_code = 1;
         }
      }
      $json = json_encode(array(
          'message' => $message,
          'data' => $data,
          'status_code' => $status_code
              ), JSON_UNESCAPED_SLASHES);
      return new Response($json, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'application/json'));
   }

   /* app token webservice */

   public function getTokens($length) {
       
      return md5(time());
   }

   /* app token webservice */

   public function getPasswordTokens($length) {
      $key = '';
      $keys = array_merge(range(0, 9), range('a', 'z'));

      for ($i = 0; $i < $length; $i++) {
         $key .= $keys[array_rand($keys)];
      }

      return $key;
   }

   public function forgotAction(Request $request) {
       $content=$this->getContentAsArray($request);
       $request->request=$content;
      $email = $request->request->get("email");
      $message = "";
      $success = "";
      $data = [];
      $status_code = 0;
      if (trim($email) == "") {
         $message.=" Please fill the required field !";
      } else {
         $user = new User();
         $em = $this->getDoctrine()->getManager();
         $users = $em->getRepository('DroidInfotechDroidBundle:User')->findByEmail($email);

         if (isset($users[0])) {
            $access_code = $this->getPasswordTokens(6);
            //$encoder = $this->container->get('security.password_encoder');
            // = $encoder->encodePassword($user, $password);
            $qb = $em->createQueryBuilder();
            $q = $qb->update('DroidInfotech\DroidBundle\Entity\User', 'u')
                    ->set('u.accessCode', '?2')
                    ->where('u.id = ?3')
                    ->setParameter(2, $access_code)
                    ->setParameter(3, $users[0]->getId())
                    ->getQuery();
            $p = $q->execute();
            $em->flush();
            $message.="The access code to reset the password has been sent to your email.";
            $passworddata = "Email:" . $users[0]->getEmail() . 'access_code:' . $access_code;
            $mail = \Swift_Message::newInstance()
                    ->setSubject('Reset Password Access Code')
                    ->setFrom($this->getParameter('fromemail'))
                    ->setTo($users[0]->getEmail())
                    ->setBody(
                    $this->renderView(
                            'emails/forgot.html.twig', array('name' => $users[0]->getName(), 'access_code' => $access_code)
                    ), 'text/html'
                    )
            ;
            $this->get('mailer')->send($mail);
            ///mail($users[0]->getEmail(),'Your Password',$passworddata);
            $status_code = 1;
            // $data = array('email' => $users[0]->getEmail(), 'password' => $password);
         } else {
            $message.="This email is not registered.";
         }
      }
      $json = json_encode(array(
          'message' => $message,
          'data' => $data,
          'status_code' => $status_code
              ), JSON_UNESCAPED_SLASHES);
      return new Response($json, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'application/json'));
   }

   public function changepasswordAction(Request $request) {
       $content=$this->getContentAsArray($request);
       $request->request=$content;
      //  $userId = $request->request->get("userId");
      $access_code = $request->request->get("access_code");
      $newPassword = $request->request->get("newPassword");
      $message = "";
      $success = "";
      $data = [];
      $status_code = 0;
      if (trim($access_code) == "") {
         $message.=" Access code is missing !";
      } else if (trim($newPassword) == "") {
         $message.=" New Password is missing !";
      } else {
         $user = new User();
         $em = $this->getDoctrine()->getManager();
         $encoder = $this->container->get('security.password_encoder');
         //$encoded = $encoder->encodePassword($user, $oldPassword);
         $users = $em->getRepository('DroidInfotechDroidBundle:User')->findByaccessCode($access_code);

         if (isset($users[0])) {
            if ($users[0]->getaccessCode() == $access_code) {
               $encoded = $encoder->encodePassword($user, $newPassword);
               $qb = $em->createQueryBuilder();
               $q = $qb->update('DroidInfotech\DroidBundle\Entity\User', 'u')
                       ->set('u.password', '?2')
                       ->set('u.accessCode', '?4')
                       ->where('u.id = ?3')
                       ->setParameter(2, $encoded)
                       ->setParameter(3, $users[0]->getId())
                       ->setParameter(4, NULL)
                       ->getQuery();
               $p = $q->execute();
               $em->flush();
               $message.="Your password has been updated successfully.";
               $status_code = 1;
               $data = array('username' => $users[0]->getUsername());
            } else {
               $message.="Incorrect access code, please enter correct access code.";
            }
         } else {
            $message.="Incorrect access code, please enter correct access code.";
         }
      }
      $json = json_encode(array(
          'message' => $message,
          'data' => $data,
          'status_code' => $status_code
              ), JSON_UNESCAPED_SLASHES);
      return new Response($json, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'application/json'));
   }

   private function saveDevicetoken($devicetoken, $devicetype, $deviceid) {
      if (trim($devicetoken) <> "" && trim($devicetype) <> "") {
         $em = $this->getDoctrine()->getManager();
         $devices = $em->getRepository('DroidInfotechDroidBundle:Device')->findBy(array('devicetype' => $devicetype, 'devicetoken' => $devicetoken));
         if (!$devices) {
            $device = new Device();
            $device->setCreatedOn(new \DateTime());
            $device->setDevicetoken($devicetoken);
            $device->setDevicetype($devicetype);
            $device->setDeviceId($deviceid);
            $device->setActive(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($device);
            $em->flush();
         }
      }
   }

   public function logoutAction(Request $request) {
       $content=$this->getContentAsArray($request);
       $request->request=$content;
      $token = $request->request->get('token');
      $devicetoken = $request->request->get('devicetoken');
      $devicetype = $request->request->get('devicetype');
      $em = $this->getDoctrine()->getManager();
      $log = $em->getRepository('DroidInfotechDroidBundle:Log')->findByUserToken($token);
      $status_code = 0;
      $message = "No Record Found";
      $data = array();
      if (!$log) {
         $status_code = 0;
         $message = "Not Valid Token";
         $data = array();
      } else {
         $request->getSession()->set('userdata', NULL);

         $queryBuilder = $em
                 ->createQueryBuilder()
                 ->delete('DroidInfotechDroidBundle:Log', 'a')
                 ->where('a.id = :parent')
                 ->setParameter('parent', $log[0]->getId());
         $queryBuilder->getQuery()->execute();
         $queryBuilder = $em
                 ->createQueryBuilder()
                 ->delete('DroidInfotechDroidBundle:Device', 'a')
                 ->where('a.devicetoken = :parent')
                 ->setParameter('parent', $devicetoken);
         $queryBuilder->getQuery()->execute();
         $message = "Logout successfully !";
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
