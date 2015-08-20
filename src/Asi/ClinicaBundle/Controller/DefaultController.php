<?php

namespace Asi\ClinicaBundle\Controller;

use Asi\ClinicaBundle\Entity\Account;
use Asi\ClinicaBundle\Form\Type\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
    	if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $tipo_usuario = $user->getIdTipoUsuario()->getNombre();


	    	$referer_parts = explode('/', $request->headers->get('referer'));
	    	$referer = '/' . $referer_parts[ (count($referer_parts)-1)];

	    	$login_url_parts = explode('/', $this->generateUrl('fos_user_security_login'));
	    	$login_url = '/' . $login_url_parts[ (count($login_url_parts)-1)];

	    	if ($referer !== NULL)
	    		if ($referer == $login_url){

	    			switch ($tipo_usuario) {
		                case 'Administrador':
		                    $redirect_route = 'asi_clinica_admin';
		                break; 
		                
		                case 'Paciente':
		                    $redirect_route = 'asi_clinica_paciente';
		                break;

		                case 'Recepcionista':
		                    $redirect_route = 'asi_clinica_recepcion';
		                break;

		                case 'Medico':
		                    $redirect_route = 'asi_clinica_medico';
		                break;
		                
		                default:
		                    $redirect_route = 'asi_clinica_homepage';
		                break;
		            }

	    			return new RedirectResponse($this->generateUrl($redirect_route));
	    		}
        }



        return $this->render('AsiClinicaBundle:Default:index.html.twig');
    }

    public function adminAction()
    {
        return $this->render('AsiClinicaBundle:Default:admin.html.twig');
    }

}


