<?php

namespace AppBundle\EventListener;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Bonnier\BonierBundle\Entity\User;

class RedirectUserListener {

    private $tokenStorage;
    private $router;

    public function __construct(TokenStorageInterface $t, RouterInterface $r) {
        $this->tokenStorage = $t;
        $this->router = $r;
    }

      public function onKernelRequest(GetResponseEvent $event)
    {
        if ($this->isUserLogged() && $event->isMasterRequest()) {
            $currentRoute = $event->getRequest()->attributes->get('_route');
            if ($this->isAuthenticatedUserOnAnonymousPage($currentRoute)) {
                $response = new RedirectResponse($this->router->generate('homepage'));
                $event->setResponse($response);
            }
        }
    }


    private function isUserLogged() {
        $user = $this->tokenStorage->getToken()->getUser();
        return $user instanceof User;
    }

    private function isAuthenticatedUserOnAnonymousPage($currentRoute) {
        return in_array(
                $currentRoute, ['fos_user_security_login', 'fos_user_resetting_request', 'app_user_registration']
        );
    }

    private function getLoggedUser() {
        $user = $this->securityContext->getToken()->getUser();
        return $user instanceof User ? $user : null;
    }

    private function getRedirectRoute($user, $currentRoute) {
        if ($this->isChangingPassword($user, $currentRoute)) {
            return 'fos_user_change_password';
        } elseif ($this->isAuthenticatedUserOnAnonymousPage($currentRoute)) {
            return 'homepage';
        }
    }

    private function isChangingPassword($user, $currentRoute) {
        return $user->hasRole('ROLE_CHANGE_PASSWORD') && strpos($currentRoute, '_profiler') === false && !in_array($currentRoute, ['_wdt', 'fos_user_change_password']);
    }

}
