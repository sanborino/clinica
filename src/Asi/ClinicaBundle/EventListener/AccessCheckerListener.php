<?php
namespace Asi\ClinicaBundle\EventListener;

use Asi\ClinicaBundle\Controller\AccessCheckerController;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AccessCheckerListener
{   

    private $rolesProvider;
    private $securityContext;
    private $entityManager;
    private $router;

    public function __construct($rolesProvider, $router, SecurityContext $securityContext, EntityManager $entityManager){

        $this->rolesProvider = $rolesProvider;
        $this->securityContext = $securityContext;
        $this->entityManager = $entityManager;
        $this->router = $router;

    }

    public function onKernelController(FilterControllerEvent $event)
    {
        if ($event->isMasterRequest()){
            $route = $event->getRequest()->get('_route');

            if ($this->isExcludedRoute($route)) return;

            if ($this->isAsset($_SERVER['REQUEST_URI'])) return;

            $is_logged = $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY');

            if (!$is_logged && $route != 'fos_user_security_login'){
                $redirectUrl = $this->router->generate('fos_user_security_login');

                $event->setController(function() use ($redirectUrl) {
                    return new RedirectResponse($redirectUrl);
                });
            }

            if (!$is_logged && $route == 'fos_user_security_login'){
                return;
            }
            
            if (!$this->rolesProvider->hasRouteAccess($route))
                throw new AccessDeniedException();
        }

    }

    private function isAsset($uri){
        
        $uri_parts = explode('.', $uri);

        $asset_formats = array(
            'js',
            'css',
            'png',
            'pneg',
            'ico',
            'jpg',
            'jpeg'
        );

        $uri_file_format = $uri_parts[(count($uri_parts)-1)];

        if (in_array($uri_file_format, $asset_formats)) return TRUE;

        return FALSE;
    }

    private function isExcludedRoute($route){

        $excluded_routes = array(
            'asi_clinica_homepage',
            'fos_user_registration_register',
            'fos_user_registration_check_email',
            'fos_user_registration_confirm',
            'fos_user_registration_confirmed',
            'fos_user_resetting_request',
            'fos_user_resetting_send_email',
            'fos_user_resetting_check_email',
            'fos_user_resetting_reset',
            'fos_user_security_check',
        );

        return in_array($route, $excluded_routes);
    }
}
