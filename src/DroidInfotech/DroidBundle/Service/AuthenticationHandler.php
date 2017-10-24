<?php
namespace DroidInfotech\DroidBundle\Service;
 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
 
class AuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface
{
    private $router;
    private $session;
 
    /**
     * Constructor
     *
     * @author     Ashwani 
     * @param     RouterInterface $router
     * @param     Session $session
     */
    public function __construct( RouterInterface $router, Session $session )
    {
        $this->router  = $router;
        $this->session = $session;
    }
    public function onKernelResponse(FilterResponseEvent $event) {
        if ($this->security->isGranted('ROLE_ADMINISTRATOR')) {
            $event->getResponse()->headers->set('Location', $this->router->generate('admin_dashboard'));
        } elseif ($this->security->isGranted('ROLE_OPERATOR')) {
            $event->getResponse()->headers->set('Location', $this->router->generate('operator_dashboard'));
        } else {
            $request = $event->getRequest();
            $session = $request->getSession();
           
        }
    }
    /**
     * onAuthenticationSuccess
     *
     * @author     Ashwani
     * @param     Request $request
     * @param     TokenInterface $token
     * @return     Response
     */
    public function onAuthenticationSuccess( Request $request, TokenInterface $token )
    {
        // if AJAX login
        if ( $request->isXmlHttpRequest() ) {
 
            $array = array( 'success' => 'loggedIn' ); // data to return via JSON
            $response = new Response( json_encode( $array ) );
            $response->headers->set( 'Content-Type', 'application/json' );
 
            return $response;
 
        // if form login
        } else {
 
            if ( $this->session->get('_security.main.target_path' ) ) {
 
                $url = $this->session->get( '_security.main.target_path' );
 
            } else {
 
                $url = $this->router->generate( 'public_index' );
 
            } // end if
 
            return new RedirectResponse( $url );
 
        }
    }
 
    /**
     * onAuthenticationFailure
     *
     * @author     Ashwani
     * @param     Request $request
     * @param     AuthenticationException $exception
     * @return     Response
     */
     public function onAuthenticationFailure( Request $request, AuthenticationException $exception )
    {
        // if AJAX login
        if ( $request->isXmlHttpRequest() ) {
 
            $array = array( 'success' => false, 'message' => $exception->getMessage() ); // data to return via JSON
            $response = new Response( json_encode( $array ) );
            $response->headers->set( 'Content-Type', 'application/json' );
 
            return $response;
 
        // if form login
        } else {
 
            // set authentication exception to session
            $request->getSession()->set(SecurityContextInterface::AUTHENTICATION_ERROR, $exception);
 
            return new RedirectResponse( $this->router->generate( 'check_login' ) );
        }
    }
}