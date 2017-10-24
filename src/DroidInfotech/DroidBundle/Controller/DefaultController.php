<?php

namespace DroidInfotech\DroidBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DroidInfotech\DroidBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\Role\RoleHierarchy;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Symfony\Component\Security\Core\Role\SwitchUserRole;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends Controller {

   /**
    * @Route("/")
    */
   public function indexAction(Request $request) {
      if (!empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('user_index');
      }

      $authenticationUtils = $this->get('security.authentication_utils');

      // get the login error if there is one
      $error = $authenticationUtils->getLastAuthenticationError();

      // last username entered by the user
      $lastUsername = $authenticationUtils->getLastUsername();

      return $this->render(
                      'default/login.html.twig', array(
                  // last username entered by the user
                  'last_username' => $lastUsername,
                  'error' => $error,
                  'defcookie' => isset($_COOKIE['offroadexpo']) ? json_decode($_COOKIE['offroadexpo']) : ''
                      )
      );
   }

   /**
    * @Route("/home",name="home_page")
    */
   public function homeAction(Request $request) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      return $this->render('default/index.html.twig', array());
   }

   /**
    * change password on adminpanel
    * 
    */
   public function updatePasswordAction(Request $request) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $error = '';
      $message = '';
      $token = $request->getSession()->get('token');
      $newpassword = $request->request->get("newpassword");
      $oldpassword = $request->request->get("oldpassword");
      $userId = $token['userId'];
      if ($request->isMethod('POST') && $oldpassword <> "" && $newpassword <> "") {
         $em = $this->getDoctrine()->getManager();
         $user = $em->getRepository('DroidInfotechDroidBundle:User')->findById($userId);

         $encoder = $this->container->get('security.password_encoder');
         $oldencoded = $encoder->encodePassword($user[0], $oldpassword);
         if ($user) {
            if (isset($user[0]) && $user[0]->getPassword() == $oldencoded) {
               $encoded = $encoder->encodePassword($user[0], $newpassword);
               $qb = $em->createQueryBuilder();
               $q = $qb->update('DroidInfotech\DroidBundle\Entity\User', 'u')
                       ->set('u.password', '?2')
                       ->where('u.id = ?3')
                       ->setParameter(2, $encoded)
                       ->setParameter(3, $user[0]->getId())
                       ->getQuery();
               $p = $q->execute();
               $em->flush();
               $message = "Password updated successfully !";
            } else {
               $error = "Old Password does not match";
            }
         }
      } else {
         $error = "All fields are required";
      }
      return $this->render('user/updatePassword.html.twig', array('error' => $error, 'message' => $message));
   }

   /**
    * change password on adminpanel
    * 
    */
   public function createnewPasswordAction(Request $request, $userId) {
      $error = '';
      $message = '';
      $newpassword = $request->request->get("newpassword");
      $userId = base64_decode($userId);
      if ($request->isMethod('POST') && $newpassword <> "" && $userId <> "") {
         $em = $this->getDoctrine()->getManager();
         $user = $em->getRepository('DroidInfotechDroidBundle:User')->findById($userId);

         $encoder = $this->container->get('security.password_encoder');

         if ($user) {

            $encoded = $encoder->encodePassword($user[0], $newpassword);
            $qb = $em->createQueryBuilder();
            $q = $qb->update('DroidInfotech\DroidBundle\Entity\User', 'u')
                    ->set('u.password', '?2')
                    ->where('u.id = ?3')
                    ->setParameter(2, $encoded)
                    ->setParameter(3, $user[0]->getId())
                    ->getQuery();
            $p = $q->execute();
            $em->flush();
            $message = "Password updated successfully !";
         }
      } else {
         $error = "All fields are required";
      }
      return $this->render('user/newPassword.html.twig', array('error' => $error, 'message' => $message, 'userId' => $userId));
   }

   /*
    * add email for creating email
    * 
    * */

   public function addUserAction(Request $request) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      $error = '';
      $message = '';
      $access_code = '';
      $users = '';
      $email = $request->request->get("email");
      $name = $request->request->get("name");
      $lname = $request->request->get("lname");
      $role = $request->request->get("roles");
      if ($request->isMethod('POST') && $email <> "") {
         $em = $this->getDoctrine()->getManager();
         $objQueryBuilder = $em->createQueryBuilder();

         /** Find if user already exists with email , That email can exixts in app* */
         $sqlToExecute = $objQueryBuilder->select(array('u'))
                 ->from('DroidInfotechDroidBundle:User', 'u')
                 ->where(
                 $objQueryBuilder->expr()->andX(
                         $objQueryBuilder->expr()->neq('u.roles', '?1'), $objQueryBuilder->expr()->eq('u.email', '?2')
         ));

         $objQueryBuilder->setParameters(array(1 => '["ROLE_APPUSER"]', 2 => $email));
         $users = $sqlToExecute->getQuery()->getResult();

         if (!$users) {
            $generatePassword = $this->generatePassword(6);
            $user = new User();

            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $generatePassword);
            $user->setCreatedOn(new \DateTime());
            $user->setUsername($email);
            $user->setName($name);
            $user->setLname($lname);
            $user->setEmail($email);
            $user->setPassword($encoded);
            $user->setRoles($role);
            $em->persist($user);
            $em->flush();
            $message .= "Password details have been sent to " . $email;
            $passworddata = "Email:" . $email;
            $userId = base64_encode($user->getId());
            $passwordlink = $this->getParameter('domain') . $this->generateUrl('create_newPassword', array('userId' => $userId));
            // $passwordlink = '<a href="'.$passwordlink.'">Click here</a> to generate password';
            $mail = \Swift_Message::newInstance()
                    ->setSubject('Off-Road Expo CMS Account Credentials')
                    ->setFrom($this->getParameter('fromemail'))
                    ->setTo($email)
                    ->setBody(
                    $this->renderView(
                            'emails/createuser.html.twig', array('email' => $email, 'link' => $passwordlink, 'name' => $name)
                    ), 'text/html'
                    )
            ;
            // echo $mail->toString();
            $this->get('mailer')->send($mail);
         } else {
            $error = $email . " already exists";
         }
      }
      return $this->render('user/adduser.html.twig', array('error' => $error, 'message' => $message));
   }

   /* app token webservice */

   public function generatePassword($length) {
      $key = '';
      $keys = array_merge(range(0, 9), range('a', 'z'));

      for ($i = 0; $i < $length; $i++) {
         $key .= $keys[array_rand($keys)];
      }

      return $key;
   }

   /**
    * @Route("/dashboard",name="dashboard_page")
    */
   public function dashboardAction(Request $request) {
      if (empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
      return $this->render('default/index.html.twig', array());
   }

   /**
    * @Route("/forgotpassword",name="forgot_page")
    */
   public function forgotAction(Request $request) {
      $error = "";
      if (!empty($request->getSession()->get('token'))) {
         return $this->redirectToRoute('check_path');
      }
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
            $message.="Your Password Details has been sent to your email";
            $passworddata = "Email:" . $users[0]->getEmail() . 'access_code:' . $access_code;
            $link = $this->getParameter('domain') . $this->generateUrl('create_newPassword', array('userId' => base64_encode($users[0]->getId())));
            $mail = \Swift_Message::newInstance()
                    ->setSubject('Your Password')
                    ->setFrom($this->getParameter('fromemail'))
                    ->setTo($users[0]->getEmail())
                    ->setBody(
                    $this->renderView(
                            'emails/forgotcmspassword.html.twig', array('name' => $users[0]->getName(), 'email' => $users[0]->getEmail(), 'link' => $link)
                    ), 'text/html'
                    )
            ;
            $this->get('mailer')->send($mail);
            //  echo $mail->toString();die;
            ///mail($users[0]->getEmail(),'Your Password',$passworddata);
            $status_code = 1;
            // $data = array('email' => $users[0]->getEmail(), 'password' => $password);
         } else {
            $message.="Not a Valid User";
         }
      }


      return $this->render('default/forgot.html.twig', array('error' => $message,));
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

   public function loginAction(Request $request) {

      $user = new User();
      $data = array();
      $message = '';
      $email = $request->request->get('_username');
      $password = $request->request->get('_password');
      $remember_me = $request->request->get('_remember_me');
      $status_code = 0;

      if ($email <> "" && $password <> "") {


         $em = $this->getDoctrine()->getManager();
         $encoder = $this->container->get('security.password_encoder');
         $encoded = $encoder->encodePassword($user, $password);


         $em = $this->getDoctrine()->getManager();
         $objQueryBuilder = $em->createQueryBuilder();

         /** Find if user already exists with email , That email can exixts in app* */
         $sqlToExecute = $objQueryBuilder->select(array('u'))
                 ->from('DroidInfotechDroidBundle:User', 'u')
                 ->where(
                 $objQueryBuilder->expr()->andX(
                         $objQueryBuilder->expr()->neq('u.roles', '?1'), $objQueryBuilder->expr()->eq('u.email', '?2')
         ));

         $objQueryBuilder->setParameters(array(1 => '["ROLE_APPUSER"]', 2 => $email));
         $users = $sqlToExecute->getQuery()->getResult();

         if (isset($users[0]) && $users[0]->getPassword() == $encoded) {
            $message .= "LoggedIn successfully !";
            $status_code = 1;
            $data = array('userId' => $users[0]->getId(), 'email' => $users[0]->getEmail(), 'Roles' => $users[0]->getRoles());
            $token = new UsernamePasswordToken($users[0], $users[0]->getPassword(), 'main', $users[0]->getRoles());
            if ($remember_me) {
               $cookie_name = "offroadexpo";
               $cookie_value = json_encode(array('email' => $email, "password" => $password));
               //setcookie ($name, $value = "", $expire = 0, $path = "", $domain = "", $secure = false, $httponly = false)
               setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            } else {
               $cookie_name = "offroadexpo";
               $cookie_value = json_encode(array('email' => '', "password" => ''));
               //setcookie ($name, $value = "", $expire = 0, $path = "", $domain = "", $secure = false, $httponly = false)
               setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            }
            //$token->setAuthenticated(true);
            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));
            $this->get('session')->save();
            $request->getSession()->set('token', $data);
            return $this->redirectToRoute('home_page');
         } else {
            $message .= "Please enter correct email and password";
         }

         $json = json_encode(array(
             'data' => $data,
             'message' => $message,
             'status_code' => $status_code
                 ), JSON_UNESCAPED_SLASHES);
         // return new Response($json, 201, array('Access-Control-Allow-Origin' => '*', 'Content-Type' => 'application/json'));
      }
      $authenticationUtils = $this->get('security.authentication_utils');

      // get the login error if there is one
      $error = $authenticationUtils->getLastAuthenticationError();

      // last username entered by the user
      $lastUsername = $authenticationUtils->getLastUsername();

      return $this->render(
                      'default/login.html.twig', array(
                  // last username entered by the user
                  'last_username' => $lastUsername,
                  'error' => $error,
                  'message' => $message,
                      )
      );
   }

   public function logoutAction(Request $request) {
      $this->get('security.token_storage')->setToken(null);
      $request->getSession()->set('token', '');
      return $this->redirectToRoute('check_path');
   }

   /**
    * mobile android notification
    *

    */
   public function androidPushAction() {
      $pushobj = $this->get('Pushnotification');
      $result = $pushobj->android(array("mdesc" => "testing"), 1);

      return;
   }

   public function iosPushAction() {
      $pushobj = $this->get('Pushnotification');
      $result = $pushobj->ios(array("mdesc" => "testing"), 1, 1);

      return;
   }

}
